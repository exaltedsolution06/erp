<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reportcard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('design_report_card', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/reportcard');
        $data['title'] = 'Add Library';

        $this->data['certificateList'] = $this->reportcard_model->get();

        $this->form_validation->set_rules('template', $this->lang->line('template'), 'trim|required|xss_clean');

        $this->form_validation->set_rules('header_img', 'header_img', 'callback_handle_upload[header_img]');
        $this->form_validation->set_rules('left_sign', $this->lang->line('sign'), 'callback_handle_upload[left_sign]');
        $this->form_validation->set_rules('middle_sign', $this->lang->line('sign'), 'callback_handle_upload[middle_sign]');
        $this->form_validation->set_rules('right_sign', $this->lang->line('sign'), 'callback_handle_upload[right_sign]');

        if ($this->form_validation->run() == true) {

            if (isset($_POST['is_name'])) {
                $is_name = 1;
            } else {
                $is_name = 0;
            }
            if (isset($_POST['is_father_name'])) {
                $is_father_name = 1;
            } else {
                $is_father_name = 0;
            }
            if (isset($_POST['is_mother_name'])) {
                $is_mother_name = 1;
            } else {
                $is_mother_name = 0;
            }
            if (isset($_POST['is_dob'])) {
                $is_dob = 1;
            } else {
                $is_dob = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
            }
            if (isset($_POST['is_roll_no'])) {
                $is_roll_no = 1;
            } else {
                $is_roll_no = 0;
            }

            if (isset($_POST['is_class'])) {
                $is_class = 1;
            } else {
                $is_class = 0;
            }

            if (isset($_POST['is_section'])) {
                $is_section = 1;
            } else {
                $is_section = 0;
            }
            if (isset($_POST['is_photo'])) {
                $is_photo = 1;
            } else {
                $is_photo = 0;
            }
            if (isset($_POST['is_contactno'])) {
                $is_contactno = 1;
            } else {
                $is_contactno = 0;
            }

            if (isset($_POST['is_header'])) {
                $is_header = 1;
				$header_height = 0;
				$footer_height = 0;
            } else {
                $is_header = 0;
				$header_height = $this->input->post('header_height');
				$footer_height = $this->input->post('footer_height');
            }
            if (isset($_POST['marks_grade_table'])) {
                $marks_grade_table = 1;
            } else {
                $marks_grade_table = 0;
            }
            if (isset($_POST['max_marks_shift_left'])) {
                $max_marks_shift_left = 1;
            } else {
                $max_marks_shift_left = 0;
            }
            if (isset($_POST['school_reopen'])) {
                $school_reopen = 1;
                $school_reopen_date = $this->input->post('school_reopen_date');
                $school_reopen_time = $this->input->post('school_reopen_time');
            } else {
                $school_reopen = 0;
                $school_reopen_date = "";
                $school_reopen_time = "";
            }
            if (isset($_POST['is_class_teacher'])) {
                $is_class_teacher = 1;
            } else {
                $is_class_teacher = 0;
            }
            if (isset($_POST['is_examination_ic'])) {
                $is_examination_ic = 1;
            } else {
                $is_examination_ic = 0;
            }
            if (isset($_POST['is_principal'])) {
                $is_principal = 1;
            } else {
                $is_principal = 0;
            }
            if (isset($_POST['is_show_date'])) {
                $is_show_date = 1;
            } else {
                $is_show_date = 0;
            }



            $insert_data = array(
                'template' => $this->input->post('template'),
                'title' => $this->input->post('title'),
                'overall_marks_title' => $this->input->post('overall_marks_title'),
                'subject_color' => $this->input->post('subject_color'),
                'scholastic_area_color' => $this->input->post('scholastic_area_color'),
                'main_subject_color' => $this->input->post('main_subject_color'),
                'is_name' => $is_name,
                'is_father_name' => $is_father_name,
                'is_mother_name' => $is_mother_name,
                'is_dob' => $is_dob,
                'is_admission_no' => $is_admission_no,
                'is_roll_no' => $is_roll_no,
                'is_class' => $is_class,
                'is_section' => $is_section,
                'is_photo' => $is_photo,
                'is_contactno' => $is_contactno,
                'exam_group_grade'=>json_encode($this->input->post('exam_group')),
                'exam_group_marks_obtained'=>json_encode($this->input->post('marks_obtained')),
                'exam_group_max_marks'=>json_encode($this->input->post('max_marks')),
                'is_header'=>$is_header,
                'marks_grade_table'=>$marks_grade_table,
                'max_marks_shift_left'=>$max_marks_shift_left,
                'school_reopen'=>$school_reopen,
                'school_reopen_date'=>$school_reopen_date,
                'school_reopen_time'=>$school_reopen_time,
                'is_class_teacher'=>$is_class_teacher,
                'is_examination_ic'=>$is_examination_ic,
                'is_principal'=>$is_principal,
                'is_show_date'=>$is_show_date,
                'left_sign' => "",
                'right_sign' => "",
                'middle_sign' => "",
                'left_sign_title' => "",
                'middle_sign_title' => "",
                'right_sign_title' => "",
                'background_image' => "",
                'header_img'=>"",
				'header_height' => $header_height,
                'footer_height' => $footer_height,
				'session_id' => $this->current_session
            );


            if (isset($_FILES["header_img"]) && !empty($_FILES["header_img"]['name'])) {
                $time = md5($_FILES["header_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["header_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["header_img"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['header_img'] = $img_name;
            }
            if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['left_sign'] = $img_name;
                $insert_data['left_sign_title'] = $this->input->post('left_sign_title');
            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['middle_sign'] = $img_name;
                $insert_data['middle_sign_title'] = $this->input->post('middle_sign_title');
            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['right_sign'] = $img_name;
                $insert_data['right_sign_title'] = $this->input->post('right_sign_title');
            }if (isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])) {
                $time = md5($_FILES["background_image"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_image"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_image"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['background_image'] = $img_name;
            }
            $this->reportcard_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/reportcard/index');
        }
		
		$this->data['exam_groups'] = $this->examgroup_model->get();

        $this->load->view('layout/header');
        $this->load->view('admin/reportcard/createreportcard', $this->data);
        $this->load->view('layout/footer');
    }

    public function handle_upload($str, $var) {

        $image_validate = $this->config->item('image_validate');
        $result = $this->filetype_model->get();
        if (isset($_FILES[$var]) && !empty($_FILES[$var]['name'])) {

            $file_type = $_FILES[$var]['type'];
            $file_size = $_FILES[$var]["size"];
            $file_name = $_FILES[$var]["name"];

            $allowed_extension = array_map('trim', array_map('strtolower', explode(',', $result->image_extension)));
            $allowed_mime_type = array_map('trim', array_map('strtolower', explode(',', $result->image_mime)));
            $ext               = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            

            if ($files = @getimagesize($_FILES[$var]['tmp_name'])) {

                if (!in_array($files['mime'], $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed'));
                    return false;
                }

                if (!in_array($ext, $allowed_extension) || !in_array($file_type, $allowed_mime_type)) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('extension_not_allowed'));
                    return false;
                }
                if ($file_size > $result->image_size) {
                    $this->form_validation->set_message('handle_upload', $this->lang->line('file_size_shoud_be_less_than') . number_format($image_validate['upload_size'] / 1048576, 2) . " MB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', $this->lang->line('file_type_not_allowed') . " " . $this->lang->line('or') . " " . $this->lang->line('extension_not_allowed'));
                return false;
            }

            return true;
        }
        return true;
    }

    public function edit($id) {
        if (!$this->rbac->hasPrivilege('design_report_card', 'can_edit')) {
            access_denied();
        }

        $data['title'] = 'Add Library';
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'Examinations/reportcard');

        $this->data['certificateList'] = $this->reportcard_model->get();

        $reportcard = $this->reportcard_model->get($id);
		if(!$reportcard){
			redirect('admin/reportcard/index');
		}
        $this->data['reportcard'] = $reportcard;

        $this->form_validation->set_rules('template', 'template', 'trim|required|xss_clean');

        $this->form_validation->set_rules('header_img', 'header_img', 'callback_handle_upload[header_img]');
        $this->form_validation->set_rules('left_sign', $this->lang->line('sign'), 'callback_handle_upload[left_sign]');
        $this->form_validation->set_rules('middle_sign', $this->lang->line('sign'), 'callback_handle_upload[middle_sign]');
        $this->form_validation->set_rules('right_sign', $this->lang->line('sign'), 'callback_handle_upload[right_sign]');

        if ($this->form_validation->run() == true) {

            if (isset($_POST['is_name'])) {
                $is_name = 1;
            } else {
                $is_name = 0;
            }
            if (isset($_POST['is_father_name'])) {
                $is_father_name = 1;
            } else {
                $is_father_name = 0;
            }
            if (isset($_POST['is_mother_name'])) {
                $is_mother_name = 1;
            } else {
                $is_mother_name = 0;
            }
            if (isset($_POST['is_dob'])) {
                $is_dob = 1;
            } else {
                $is_dob = 0;
            }

            if (isset($_POST['is_admission_no'])) {
                $is_admission_no = 1;
            } else {
                $is_admission_no = 0;
            }
            if (isset($_POST['is_roll_no'])) {
                $is_roll_no = 1;
            } else {
                $is_roll_no = 0;
            }

            if (isset($_POST['is_class'])) {
                $is_class = 1;
            } else {
                $is_class = 0;
            }

            if (isset($_POST['is_section'])) {
                $is_section = 1;
            } else {
                $is_section = 0;
            }
            if (isset($_POST['is_photo'])) {
                $is_photo = 1;
            } else {
                $is_photo = 0;
            }
            if (isset($_POST['is_contactno'])) {
                $is_contactno = 1;
            } else {
                $is_contactno = 0;
            }

            if (isset($_POST['is_header'])) {
                $is_header = 1;
				$header_height = 0;
				$footer_height = 0;
            } else {
                $is_header = 0;
				$header_height = $this->input->post('header_height');
				$footer_height = $this->input->post('footer_height');
            }

            if (isset($_POST['marks_grade_table'])) {
                $marks_grade_table = 1;
            } else {
                $marks_grade_table = 0;
            }
            if (isset($_POST['max_marks_shift_left'])) {
                $max_marks_shift_left = 1;
            } else {
                $max_marks_shift_left = 0;
            }
            if (isset($_POST['school_reopen'])) {
                $school_reopen = 1;
                $school_reopen_date = $this->input->post('school_reopen_date');
                $school_reopen_time = $this->input->post('school_reopen_time');
            } else {
                $school_reopen = 0;
				$school_reopen_date = "";
                $school_reopen_time = "";
            }
            if (isset($_POST['is_class_teacher'])) {
                $is_class_teacher = 1;
            } else {
                $is_class_teacher = 0;
            }
            if (isset($_POST['is_examination_ic'])) {
                $is_examination_ic = 1;
            } else {
                $is_examination_ic = 0;
            }
            if (isset($_POST['is_principal'])) {
                $is_principal = 1;
            } else {
                $is_principal = 0;
            }
            if (isset($_POST['is_show_date'])) {
                $is_show_date = 1;
            } else {
                $is_show_date = 0;
            }


            $insert_data = array(
                'id' => $this->input->post('id'),
                'template' => $this->input->post('template'),
                'title' => $this->input->post('title'),
                'overall_marks_title' => $this->input->post('overall_marks_title'),
                'subject_color' => $this->input->post('subject_color'),
                'scholastic_area_color' => $this->input->post('scholastic_area_color'),
                'main_subject_color' => $this->input->post('main_subject_color'),
                'is_name' => $is_name,
                'is_father_name' => $is_father_name,
                'is_mother_name' => $is_mother_name,
                'is_dob' => $is_dob,
                'is_admission_no' => $is_admission_no,
                'is_roll_no' => $is_roll_no,
                'is_class' => $is_class,
                'is_section' => $is_section,
                'is_photo' => $is_photo,
                'is_contactno' => $is_contactno,
                'exam_group_grade'=>json_encode($this->input->post('exam_group')),
                'exam_group_marks_obtained'=>json_encode($this->input->post('marks_obtained')),
                'exam_group_max_marks'=>json_encode($this->input->post('max_marks')),
                'is_header'=>$is_header,
                'marks_grade_table'=>$marks_grade_table,
                'max_marks_shift_left'=>$max_marks_shift_left,
                'school_reopen'=>$school_reopen,
                'school_reopen_date'=>$school_reopen_date,
                'school_reopen_time'=>$school_reopen_time,
				'header_height' => $header_height,
                'footer_height' => $footer_height,
                'is_class_teacher'=>$is_class_teacher,
                'is_examination_ic'=>$is_examination_ic,
                'is_principal'=>$is_principal,
                'is_show_date'=>$is_show_date,
            );
            
            
            if (isset($_FILES["header_img"]) && !empty($_FILES["header_img"]['name'])) {
                $time = md5($_FILES["header_img"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["header_img"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["header_img"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['header_img'] = $img_name;
            }
            if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['left_sign'] = $img_name;
				$insert_data['left_sign_title'] = $this->input->post('left_sign_title');
            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['middle_sign'] = $img_name;
				$insert_data['middle_sign_title'] = $this->input->post('middle_sign_title');
            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['right_sign'] = $img_name;
				$insert_data['right_sign_title'] = $this->input->post('right_sign_title');
            }if (isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])) {
                $time = md5($_FILES["background_image"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_image"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_image"]["tmp_name"], "./uploads/reportcard/" . $img_name);
                $insert_data['background_image'] = $img_name;
            }

            $this->reportcard_model->add($insert_data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/reportcard/index');
        }
		
		$this->data['exam_groups'] = $this->examgroup_model->get();

        $this->load->view('layout/header');
        $this->load->view('admin/reportcard/editreportcard', $this->data);
        $this->load->view('layout/footer');
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('design_report_card', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Certificate List';
        $this->reportcard_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/reportcard/index');
    }

    public function view() {
        $id = $this->input->post('certificateid');
        $output = '';
        $data = array();

        $data['reportcard'] = $this->reportcard_model->get($id);
        $page = $this->load->view('admin/reportcard/_view', $data, true);
        echo json_encode(array('status' => 1, 'page' => $page));
    }

}
