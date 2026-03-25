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
			if (!empty($_FILES['signature']['name'])) {
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
			}
			if (!empty($_FILES['background_image']['name'])) {
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
			}
			
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
			
			if ($this->input->post('is_signature') == 1) {
                $enable_signature = $this->input->post('is_signature');
            } else {
                $enable_signature = 0;
            }
            if (isset($_POST['is_show_date'])) {
                $is_show_date = 1;
                $show_date = $this->input->post('show_date');
            } else {
                $is_show_date = 0;
                $show_date = '';
            }

            $data = [
                'certificate_name' => $this->input->post('certificate_name'),
                'fields_json'      => json_encode($fields),
                'status'           => 1,
                'session_id'       => $this->current_session,
                'signature_title' => $this->input->post('signature_title'),
                'signature' => $picture,
                'is_signature' => $enable_signature,
                'background_image' => $bg_image,
                'is_show_date'=>$is_show_date,
                'show_date'=>$show_date,
            ];

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
			
			if ($this->input->post('is_signature') == 1) {
                $enable_signature = $this->input->post('is_signature');
            } else {
                $enable_signature = 0;
            }
            if (isset($_POST['is_show_date'])) {
                $is_show_date = 1;
                $show_date = $this->input->post('show_date');
            } else {
                $is_show_date = 0;
                $show_date = '';
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
			if (!empty($_FILES['signature']['name'])) {
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
			}
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
                'signature_title' => $this->input->post('signature_title'),
				'signature' => $picture,
				'is_signature' => $enable_signature,
				'background_image' => $bg_image,
                'is_show_date'=>$is_show_date,
                'show_date'=>$show_date,
			];

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