<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designtc extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('Customlib');
        $this->load->model('designtc_model');
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('design_tc', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/designtc');

        // $custom_fields = $this->customfield_model->get_custom_fields('students');
        $this->data['custom_fields'] = $custom_fields;
        $this->data['certificateList'] = $this->designtc_model->get();
        $this->load->view('layout/header');
        $this->load->view('admin/certificate/createtc', $this->data);
        $this->load->view('layout/footer');
    }

    public function create() {
        if (!$this->rbac->hasPrivilege('design_tc', 'can_add')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/designtc');
		
        $this->form_validation->set_rules('certificate_name', 'Certificate Name', 'required');
		
        if ($this->form_validation->run() == FALSE) {
			$this->data['certificateList'] = $this->designtc_model->get();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/createtc', $this->data);
            $this->load->view('layout/footer');
        } else {
			/*if (!empty($_FILES['signature']['name'])) {
				$config['upload_path'] = 'uploads/transfer_certificate/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = time().$_FILES['signature']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('signature')) {
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];
				} else {
					$picture = '';
				}
			} else {
				$picture = '';
			}*/
			/*if (!empty($_FILES['background_image']['name'])) {
				$config['upload_path'] = 'uploads/transfer_certificate/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = time().$_FILES['background_image']['name'].'bg';

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('background_image')) {
					$uploadData = $this->upload->data();
					$bg_image = $uploadData['file_name'];
				} else {
					$bg_image = '';
				}
			} else {
				$bg_image = '';
			}*/
			
            $titles = $this->input->post('field_title');
            $values = $this->input->post('field_value');

            $fields = [];

            if(!empty($titles)){
                foreach($titles as $key => $title){
                    if(!empty($title)){
                        $fields[] = [
                            'title' => $title,
                            'value' => $values[$key] ?? ''
                        ];
                    }
                }
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
                $show_date = $this->input->post('show_date');
            } else {
                $is_show_date = 0;
                $show_date = '';
            }
			if (isset($_POST['is_common_header'])) {
                $is_common_header = 1;
				$header_height = 0;
				$footer_height = 0;
            } else {
                $is_common_header = 0;
				$header_height = $this->input->post('header_height');
				$footer_height = $this->input->post('footer_height');
            }

            $data = [
                'certificate_name' => $this->input->post('certificate_name'),
                'fields_json'      => json_encode($fields),
                'status'           => 1,
                'session_id'       => $this->current_session,
				'is_common_header'=>$is_common_header,
				'header_height' => $header_height,
                'footer_height' => $footer_height,
                'is_class_teacher'=>$is_class_teacher,
                'is_examination_ic'=>$is_examination_ic,
                'is_principal'=>$is_principal,
				'left_sign' => "",
                'right_sign' => "",
                'middle_sign' => "",
                'background_image' => "",
                'is_show_date'=>$is_show_date,
                'show_date'=>$show_date,
            ];
			if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['left_sign'] = $img_name;
            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['middle_sign'] = $img_name;
            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['right_sign'] = $img_name;
            }if (isset($_FILES["background_image"]) && !empty($_FILES["background_image"]['name'])) {
                $time = md5($_FILES["background_image"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["background_image"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["background_image"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['background_image'] = $img_name;
            }

            $this->designtc_model->addcertificate($data);

            $this->session->set_flashdata('msg','<div class="alert alert-success">Saved Successfully</div>');
            redirect('admin/designtc');
        }
    }
 
    function edit($id) {

        if (!$this->rbac->hasPrivilege('design_tc', 'can_edit')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/designtc');
		
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $editcertificate = $this->designtc_model->get($id);
		if(!$editcertificate){
			redirect('admin/designtc');
		}
        // $this->data['editcertificate'] = $editcertificate;

        $custom_fields = $this->customfield_model->get_custom_fields('students');
        $this->data['custom_fields'] = $custom_fields;
        $this->form_validation->set_rules('certificate_name', 'Certificate Name', 'required');
		
        if ($this->form_validation->run() == FALSE) {
            $data['editcertificate'] = $this->designtc_model->get($id);
			$data['certificateList'] = $this->designtc_model->get();
			$this->load->view('layout/header');
			$this->load->view('admin/certificate/edittc', $data);
			$this->load->view('layout/footer');
        } else {
			$titles = $this->input->post('field_title');
			$values = $this->input->post('field_value');

			$fields = [];

			if(!empty($titles)){
				foreach($titles as $key => $title){
					if(!empty($title)){
						$fields[] = [
							'title' => $title,
							'value' => $values[$key] ?? ''
						];
					}
				}
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
                $show_date = $this->input->post('show_date');
            } else {
                $is_show_date = 0;
                $show_date = '';
            }
			if (isset($_POST['is_common_header'])) {
                $is_common_header = 1;
				$header_height = 0;
				$footer_height = 0;
            } else {
                $is_common_header = 0;
				$header_height = $this->input->post('header_height');
				$footer_height = $this->input->post('footer_height');
            }
			
			$picture = $editcertificate[0]->signature;
			$bg_image = $editcertificate[0]->background_image;
			if ($_POST['remove_signature'] == 1) {
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->signature;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
				$picture = '';
			}
			if ($_POST['remove_background_image'] == 1) {
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->background_image;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
				$bg_image = '';
			}
			/*if (!empty($_FILES['signature']['name'])) {
				$config['upload_path'] = 'uploads/transfer_certificate/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = time().$_FILES['signature']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('signature')) {
					$uploadData = $this->upload->data();
					$picture = $uploadData['file_name'];
				}
				
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->signature;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
			}*/
			if (!empty($_FILES['background_image']['name'])) {
				$config['upload_path'] = 'uploads/transfer_certificate/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = 'bg'.time().$_FILES['background_image']['name'];

				//Load upload library and initialize configuration
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('background_image')) {
					$uploadData = $this->upload->data();
					$bg_image = $uploadData['file_name'];
				}
				
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->background_image;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
			}
			
			$data = [
				'id'               => $id,
				'certificate_name' => $this->input->post('certificate_name'),
				'fields_json'      => json_encode($fields),
				'is_common_header'=>$is_common_header,
				'header_height' => $header_height,
                'footer_height' => $footer_height,
				'is_class_teacher'=>$is_class_teacher,
                'is_examination_ic'=>$is_examination_ic,
                'is_principal'=>$is_principal,
				'left_sign_title' => $this->input->post('left_sign_title'),
                'middle_sign_title' => $this->input->post('middle_sign_title'),
                'right_sign_title' => $this->input->post('right_sign_title'),
				'background_image' => $bg_image,
                'is_show_date'=>$is_show_date,
                'show_date'=>$show_date,
			];
			if ($_POST['remove_left_sign'] == 1) {
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->left_sign;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
				$data['left_sign'] = '';
			}
            if ($_POST['remove_middle_sign'] == 1) {
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->middle_sign;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
				$data['middle_sign'] = '';
			}
            if ($_POST['remove_right_sign'] == 1) {
				$path1 = "uploads/transfer_certificate/" . $editcertificate[0]->right_sign;
				$url = FCPATH . $path1;
				if (file_exists($url)) {
					unlink($url);
				}
				$data['right_sign'] = '';
			}
			if (isset($_FILES["left_sign"]) && !empty($_FILES["left_sign"]['name'])) {
                $time = md5($_FILES["left_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["left_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["left_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['left_sign'] = $img_name;
            }if (isset($_FILES["middle_sign"]) && !empty($_FILES["middle_sign"]['name'])) {
                $time = md5($_FILES["middle_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["middle_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["middle_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['middle_sign'] = $img_name;
            }if (isset($_FILES["right_sign"]) && !empty($_FILES["right_sign"]['name'])) {
                $time = md5($_FILES["right_sign"]['name'] . microtime());
                $fileInfo = pathinfo($_FILES["right_sign"]["name"]);
                $img_name = $time . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["right_sign"]["tmp_name"], "./uploads/transfer_certificate/" . $img_name);
                $data['right_sign'] = $img_name;
            }

			$this->designtc_model->addcertificate($data);

			$this->session->set_flashdata('msg','<div class="alert alert-success">Updated Successfully</div>');
			redirect('admin/designtc');
        }
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('design_tc', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Certificate List';
        $this->designtc_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/designtc');
    }
}
?>