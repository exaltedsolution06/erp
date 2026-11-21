<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Per-request cache used by the fee report views (Defaulter / Overall collection / Income / Expense ...).
 * Those views repeat the same lookups for every student row (fee plan, route plan, discounts, receipts,
 * fee group / route names). Each distinct lookup now runs once per page. Results are identical.
 */
if (!class_exists('Report_cache')) {

    class Report_cache
    {
        private $CI;
        private $c = array();
        private $receipt3 = array(); // student|head|month
        private $receipt4 = array(); // student|head|month|type
        private $fg = null;
        private $rh_obj = null;
        private $rh_row = null;
        private $counts = null;

        public function __construct($CI, $rows = array())
        {
            $this->CI = $CI;
            $this->preload_receipts($rows);
        }

        private function memo($key, $fn)
        {
            if (!array_key_exists($key, $this->c)) {
                $this->c[$key] = $fn();
            }
            // callers modify ->amount on the returned row, so hand out a copy
            return is_object($this->c[$key]) ? clone $this->c[$key] : $this->c[$key];
        }

        public function fee_plan_join($head_id, $class_id, $category_id)
        {
            $CI = $this->CI;
            return $this->memo('fpj|' . $head_id . '|' . $class_id . '|' . $category_id, function () use ($CI, $head_id, $class_id, $category_id) {
                $CI->db->from('fee_head');
                $CI->db->join('fees_plan', 'fee_head.id = fees_plan.fee_group_id');
                $CI->db->where('fees_plan.fee_group_id', $head_id);
                $CI->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
                $CI->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
                return $CI->db->get()->row();
            });
        }

        public function fee_plan_only($head_id, $class_id, $category_id)
        {
            $CI = $this->CI;
            return $this->memo('fpo|' . $head_id . '|' . $class_id . '|' . $category_id, function () use ($CI, $head_id, $class_id, $category_id) {
                $CI->db->from('fees_plan');
                $CI->db->where('fee_group_id', $head_id);
                $CI->db->where("JSON_CONTAINS(fees_plan.class_ids, '\"$class_id\"')", null, false);
                $CI->db->where("JSON_CONTAINS(fees_plan.category_ids, '\"$category_id\"')", null, false);
                return $CI->db->get()->row();
            });
        }

        public function route_plan_join($route_id, $class_id, $category_id)
        {
            $CI = $this->CI;
            return $this->memo('rpj|' . $route_id . '|' . $class_id . '|' . $category_id, function () use ($CI, $route_id, $class_id, $category_id) {
                $CI->db->from('route_head');
                $CI->db->join('route_plan', 'route_head.id = route_plan.fee_group_id');
                $CI->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
                $CI->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
                $CI->db->where('route_head.id', $route_id);
                return $CI->db->get()->row();
            });
        }

        public function route_plan_only($route_id, $class_id, $category_id)
        {
            $CI = $this->CI;
            return $this->memo('rpo|' . $route_id . '|' . $class_id . '|' . $category_id, function () use ($CI, $route_id, $class_id, $category_id) {
                $CI->db->from('route_plan');
                $CI->db->where('fee_group_id', $route_id);
                $CI->db->where("JSON_CONTAINS(route_plan.class_ids, '\"$class_id\"')", null, false);
                $CI->db->where("JSON_CONTAINS(route_plan.category_ids, '\"$category_id\"')", null, false);
                return $CI->db->get()->row();
            });
        }

        public function all_fees($student_session_id)
        {
            $CI = $this->CI;
            return $this->memo('af|' . $student_session_id, function () use ($CI, $student_session_id) {
                return $CI->fee_discount_model->get_all_fees($student_session_id);
            });
        }

        public function all_routes($student_session_id)
        {
            $CI = $this->CI;
            return $this->memo('ar|' . $student_session_id, function () use ($CI, $student_session_id) {
                return $CI->fee_discount_model->get_all_routes($student_session_id);
            });
        }

        private function preload_receipts($rows)
        {
            if (empty($rows)) {
                return;
            }
            $ids = array();
            foreach ($rows as $r) {
                $r = (array) $r;
                if (isset($r['student_id'])) {
                    $ids[$r['student_id']] = $r['student_id'];
                }
            }
            foreach (array_chunk(array_values($ids), 500) as $chunk) {
                $q = $this->CI->db->select('student_id, fee_head_name, fee_head_type, months')->where_in('student_id', $chunk)->get('receipts')->result();
                foreach ($q as $r) {
                    $base = $r->student_id . '|' . mb_strtolower((string) $r->fee_head_name) . '|' . $r->months;
                    $this->receipt3[$base] = true;
                    $this->receipt4[$base . '|' . mb_strtolower((string) $r->fee_head_type)] = true;
                }
            }
        }

        /** true when a receipt exists for student + fee head (+ optional fee_head_type) + month */
        public function receipt_exists($student_id, $head_name, $month, $type = null)
        {
            $base = $student_id . '|' . mb_strtolower((string) $head_name) . '|' . $month;
            if ($type === null) {
                return isset($this->receipt3[$base]);
            }
            return isset($this->receipt4[$base . '|' . mb_strtolower((string) $type)]);
        }

        private function load_lookups()
        {
            if ($this->fg !== null) {
                return;
            }
            $this->fg = array();
            $this->rh_obj = array();
            $this->rh_row = array();
            foreach ($this->CI->db->select('id, name')->get('fee_groups')->result() as $r) {
                $this->fg[$r->id] = $r->name;
            }
            foreach ($this->CI->db->get('route_head')->result() as $r) {
                $this->rh_obj[$r->id] = $r;
                $this->rh_row[$r->id] = (array) $r;
            }
        }

        /** fee group name or null */
        public function fee_group_name($id)
        {
            $this->load_lookups();
            return isset($this->fg[$id]) ? $this->fg[$id] : null;
        }

        /** route_head row as object or null */
        public function route_obj($id)
        {
            $this->load_lookups();
            return isset($this->rh_obj[$id]) ? $this->rh_obj[$id] : null;
        }

        /** route_head row as array or null */
        public function route_row($id)
        {
            $this->load_lookups();
            return isset($this->rh_row[$id]) ? $this->rh_row[$id] : null;
        }

        /** students per class/section (all sessions, same as the old per-checkbox COUNT(*)) */
        public function section_count($class_id, $section_id)
        {
            if ($this->counts === null) {
                $this->counts = array();
                foreach ($this->CI->db->select('class_id, section_id, COUNT(*) AS total', false)->group_by(array('class_id', 'section_id'))->get('student_session')->result() as $r) {
                    $this->counts[$r->class_id . '-' . $r->section_id] = (int) $r->total;
                }
            }
            $k = $class_id . '-' . $section_id;
            return isset($this->counts[$k]) ? $this->counts[$k] : 0;
        }
    }
}
