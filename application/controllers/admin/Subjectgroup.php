<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Subjectgroup extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('subject_group', 'can_view')) {
            access_denied();
        }


        $json_array = array();
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subjectgroup/index');
        $data['title'] = 'Add Class';
        $data['title_list'] = 'Class List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['section_array'] = $json_array;

        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array(
            'required',
            array('class_exists', array($this->subjectgroup_model, 'class_exists')),
                )
        );

        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('subject[]', $this->lang->line('subject'), 'trim|required|xss_clean');



        $this->form_validation->set_rules(
                'sections[]', $this->lang->line('section'), array(
            'required',
            array('check_section_exists', array($this->subjectgroup_model, 'check_section_exists'))
                )
        );


        if ($this->form_validation->run() == false) {
            $data['section_array'] = $this->input->post('sections');
        } else {
            $name = $this->input->post('name');
            $session = $this->setting_model->getCurrentSession();
            $class_array = array(
                'name' => $this->input->post('name'),
                'session_id' => $session,
                'description' => $this->input->post('description'),
            );
            $subject = $this->input->post('subject');
            $sections = $this->input->post('sections');
			//echo "<pre>";print_r($sections);die;

            $this->subjectgroup_model->add($class_array, $subject, $sections);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/subjectgroup');
        }
        $subject_list = $this->subject_model->get();
        $data['subjectlist'] = $subject_list;
        $subjectgroupList = $this->subjectgroup_model->getByID();
        $data['subjectgroupList'] = $subjectgroupList;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subjectgroup/subjectgroupList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('subject_group', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
		//echo $id; die;
		// By ES
		$current_session_id = $this->setting_model->getCurrentSession();
		
		$this->db->select('subject_group_class_sections.subject_group_id,class_sections.class_id,class_sections.section_id,subject_group_subjects.subject_id');
		$this->db->from('subject_group_class_sections');
		$this->db->join('subject_group_subjects', 'subject_group_subjects.subject_group_id = subject_group_class_sections.subject_group_id');
		$this->db->join('class_sections', 'class_sections.id = subject_group_class_sections.class_section_id');
		$this->db->where('subject_group_class_sections.session_id', $current_session_id);
		$this->db->where('subject_group_class_sections.subject_group_id', $id);
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		$subject_array = [];
		foreach($query->result_array() as $key => $val)
		{
			if (empty($subject_array)) {
				$subject_array[$key] = [
					'class_id' =>	$val['class_id'],
					'section_id' =>	$val['section_id'],
					'subject' =>	[],
				];
			 }
			$subject_array[0]['subject'][] = $val['subject_id'];
		}
		$subject_array = array_values($subject_array);
		
		//echo "<pre>";print_r($subject_array);
		$checkData['menu'] = 'subjectgroup';
		$checkData['table'] = '';
		$checkData['field'] = 'id';
		$checkData['subject_array'] = $subject_array;
		$ifsection = $this->Setting_model->checkDeleteList($checkData);
		
		if($ifsection > 0)
		{
			$this->session->set_flashdata('editmsg', '<div class="alert alert-danger text-left">Subject group already used in exam term</div>');
		}
		else{
			$this->subjectgroup_model->remove($id);
			$this->session->set_flashdata('editmsg', '<div class="alert alert-success text-left">Subject group deleted successfully</div>');
		}
		
        //$this->subjectgroup_model->remove($id);
        redirect('admin/subjectgroup');
    }

    public function edit($id) {
        if (!$this->rbac->hasPrivilege('subject_group', 'can_edit')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subjectgroup/index');
        $json_array = array();
        $old_sections = array();
        $old_subjects = array();
        $data['title'] = 'Edit Class';
        $data['id'] = $id;
        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $subject_list = $this->subject_model->get();
        $data['subjectlist'] = $subject_list;
        $subjectgroupList = $this->subjectgroup_model->getByID();
        $data['class_id'] = 0;
        $data['subjectgroupList'] = $subjectgroupList;
        $subjectgroup = $this->subjectgroup_model->getByID($id);
		//echo "<pre>";print_r($subjectgroup);die;
		
		if(empty($subjectgroup))
		{
			redirect('admin/subjectgroup/index');
		}

        if (!empty($subjectgroup[0]->sections)) {

            $data['class_id'] = $subjectgroup[0]->sections[0]->class_id;
            foreach ($subjectgroup[0]->sections as $key => $value) {

                $old_sections[] = ($value->class_section_id);
                $json_array[] = ($value->class_section_id);
            }
        }
        if (!empty($subjectgroup[0]->group_subject)) {


            foreach ($subjectgroup[0]->group_subject as $key => $value) {

                $old_subjects[] = $value->subject_id;
            }
        }
		
		//echo "<pre>";print_r($old_subjects);die;

        $data['section_array'] = $json_array;

        $data['subjectgroup'] = $subjectgroup;
        $this->form_validation->set_rules(
                'name', $this->lang->line('name'), array(
            'required',
            array('class_exists', array($this->subjectgroup_model, 'class_exists')),
                )
        );

        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');

        $this->form_validation->set_rules(
                'sections[]', $this->lang->line('section'), array(
            'required',
            array('check_section_exists', array($this->subjectgroup_model, 'check_section_exists'))
                )
        );

        $this->form_validation->set_rules('subject[]', $this->lang->line('subject'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            if ($this->input->server('REQUEST_METHOD') == "POST") {
                $data['section_array'] = $this->input->post('sections');
            }

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subjectgroup/subjectgroupEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class_array = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
            );
            $subject = $this->input->post('subject');
            $sections = $this->input->post('sections');
            $delete_sections = array_diff($old_sections, $sections);
            $add_sections = array_diff($sections, $old_sections);
            $delete_subjects = array_diff($old_subjects, $subject);
            $add_subjects = array_diff($subject, $old_subjects);
            $this->subjectgroup_model->edit($class_array, $delete_sections, $add_sections, $delete_subjects, $add_subjects);
            redirect('admin/subjectgroup');
        }
    }

    public function addsubjectgroup() {
        $this->form_validation->set_rules('subject_group_id', $this->lang->line('fee_group'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'subject_group_id' => form_error('subject_group_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $student_session_id = $this->input->post('student_session_id');
            $subject_group_id = $this->input->post('subject_group_id');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids = $this->input->post('student_ids');
            $delete_student = array_diff($student_ids, $student_sesssion_array);

            $preserve_record = array();
            if (!empty($student_sesssion_array)) {
                foreach ($student_sesssion_array as $key => $value) {

                    $insert_array = array(
                        'student_session_id' => $value,
                        'subject_group_id' => $subject_group_id,
                        'session_id' => $this->current_session
                    );
                    $inserted_id = $this->studentsubjectgroup_model->add($insert_array);

                    $preserve_record[] = $inserted_id;
                }
            }

            if (!empty($delete_student)) {
                $this->studentsubjectgroup_model->delete($subject_group_id, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => $this->lang->line('success_message'));
            echo json_encode($array);
        }
    }

    public function getGroupByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->subjectgroup_model->getGroupByClassandSection($class_id, $section_id);

        echo json_encode($data);
    }

    public function getSubjectByClassandSectionDate() {


        $date = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));

        $day = date('l', strtotime($date));

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->subjecttimetable_model->getSubjectByClassandSectionDay($class_id, $section_id, $day);
        echo json_encode($data);
    }

    public function getSubjectByClassandSection() {


        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->subjecttimetable_model->getSubjectByClassandSection($class_id, $section_id);
        echo json_encode($data);
    }

    public function getGroupsubjects() {

        $subject_group_id = $this->input->post('subject_group_id');
        $data = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
        echo json_encode($data);
    }

}
