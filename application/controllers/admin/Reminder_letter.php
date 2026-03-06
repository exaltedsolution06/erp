<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reminder_letter extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('Customlib');
        $this->load->model('Reminder_model');
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('reminder_letter', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Certificate');
        $this->session->set_userdata('sub_menu', 'admin/certificate');

        $custom_fields = $this->customfield_model->get_custom_fields('students');
        $this->data['custom_fields'] = $custom_fields;
        $this->data['certificateList'] = $this->Reminder_model->remindLetterList();
        $this->load->view('layout/header');
        //$this->load->view('admin/certificate/createcertificate', $this->data);
        $this->load->view('admin/certificate/reminder_letter', $this->data);
        $this->load->view('layout/footer');
    }

    public function create() {
        if (!$this->rbac->hasPrivilege('reminder_letter', 'can_add')) {
            access_denied();
        }

        $data['title'] = 'Add Library';
		//echo "<pre>";print_r($_FILES);
		//echo "<pre>";print_r($this->input->post());die;

        if (!empty($_FILES['header_image']['name'])) {
            $config['upload_path'] = 'uploads/remind_letter/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['header_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('header_image')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }

        $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('template_name', $this->lang->line('template_name'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $this->data['certificateList'] = $this->Reminder_model->remindLetterList();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/reminder_letter', $this->data);
            $this->load->view('layout/footer');
        } else {
			
            if ($this->input->post('is_active_uid_no') == 1) {
                $enable_uid_no = $this->input->post('is_active_uid_no');
            } else {
                $enable_uid_no = 0;
            }
			
			if ($this->input->post('is_active_student_name') == 1) {
                $enable_student_name = $this->input->post('is_active_student_name');
            } else {
                $enable_student_name = 0;
            }
			
			if ($this->input->post('is_active_father_name') == 1) {
                $enable_father_name = $this->input->post('is_active_father_name');
            } else {
                $enable_father_name = 0;
            }
			
			if ($this->input->post('is_active_class_section') == 1) {
                $enable_class_section = $this->input->post('is_active_class_section');
            } else {
                $enable_class_section = 0;
            }
			
			if ($this->input->post('is_active_phone') == 1) {
                $enable_phone = $this->input->post('is_active_phone');
            } else {
                $enable_phone = 0;
            }
			
			if ($this->input->post('is_active_date') == 1) {
                $enable_date = $this->input->post('is_active_date');
            } else {
                $enable_date = 0;
            }
			
			
            $data = array(
				'session_id' => $this->current_session,
                'template_name' => $this->input->post('template_name'),
                'uid_no' => $enable_uid_no,
                'student_name' => $enable_student_name,
                'father_name' => $enable_father_name,
                'class_section' => $enable_class_section,
                'phone' => $enable_phone,
                'date' => $enable_date,
                'header_image' => $picture,
                
                'description' => $this->input->post('description'),
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->Reminder_model->addReminder($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/Reminder_letter/index');
        }
    }
 
    function edit($id) {

        if (!$this->rbac->hasPrivilege('reminder_letter', 'can_edit')) {
            access_denied();
        }
		
        $data['title'] = 'Add Hostel';
        $data['id'] = $id;
        $editcertificate = $this->Reminder_model->get($id);
		
		//echo "<pre>";print_r($editcertificate[0]);die;
		if(empty($editcertificate[0])){
			redirect('admin/Reminder_letter/index');
		}
		
		
        $this->data['editcertificate'] = $editcertificate;
		//echo "<pre>";print_r($editcertificate);die;
        //$custom_fields = $this->customfield_model->get_custom_fields('students');
        //$this->data['custom_fields'] = $custom_fields;
        $this->form_validation->set_rules('template_name', $this->lang->line('template_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
			//echo "<pre>";print_r($editcertificate);die;
            $this->data['certificateList'] = $this->Reminder_model->remindLetterList();
            $this->load->view('layout/header');
            $this->load->view('admin/certificate/edit_reminder_letter', $this->data);
            $this->load->view('layout/footer');
        } else {
            
			if ($this->input->post('is_active_uid_no') == 1) {
                $enable_uid_no = $this->input->post('is_active_uid_no');
            } else {
                $enable_uid_no = 0;
            }
			
			if ($this->input->post('is_active_student_name') == 1) {
                $enable_student_name = $this->input->post('is_active_student_name');
            } else {
                $enable_student_name = 0;
            }
			
			if ($this->input->post('is_active_father_name') == 1) {
                $enable_father_name = $this->input->post('is_active_father_name');
            } else {
                $enable_father_name = 0;
            }
			
			if ($this->input->post('is_active_class_section') == 1) {
                $enable_class_section = $this->input->post('is_active_class_section');
            } else {
                $enable_class_section = 0;
            }
			
			if ($this->input->post('is_active_phone') == 1) {
                $enable_phone = $this->input->post('is_active_phone');
            } else {
                $enable_phone = 0;
            }
			
			if ($this->input->post('is_active_date') == 1) {
                $enable_date = $this->input->post('is_active_date');
            } else {
                $enable_date = 0;
            }
			
            if (!empty($_FILES['header_image']['name'])) {

                $config['upload_path'] = 'uploads/remind_letter/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['header_image']['name'];

                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('header_image')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                    $data = array(
                        'id' => $this->input->post('id'),
                        'template_name' => $this->input->post('template_name'),
						'uid_no' => $enable_uid_no,
						'student_name' => $enable_student_name,
						'father_name' => $enable_father_name,
						'class_section' => $enable_class_section,
						'phone' => $enable_phone,
						'date' => $enable_date,
						'header_image' => $picture,
						
						'description' => $this->input->post('description'),
                    );
					
					//$path = 'uploads/remind_letter' . $editcertificate[0]->header_image;
					if (!empty($editcertificate[0]->header_image)) {
						$path = 'uploads/remind_letter/' . $editcertificate[0]->header_image;

						if (is_file($path)) {
							unlink($path);
						}
					}
					
                } else {
                    $picture = '';
                    $data = array(
                        'id' => $this->input->post('id'),
                       'template_name' => $this->input->post('template_name'),
						'uid_no' => $enable_uid_no,
						'student_name' => $enable_student_name,
						'father_name' => $enable_father_name,
						'class_section' => $enable_class_section,
						'phone' => $enable_phone,
						'date' => $enable_date,
						'description' => $this->input->post('description'),
                    );
                }
            } else {
				
                $data = array(
                    'id' => $this->input->post('id'),
					'template_name' => $this->input->post('template_name'),
					'uid_no' => $enable_uid_no,
					'student_name' => $enable_student_name,
					'father_name' => $enable_father_name,
					'class_section' => $enable_class_section,
					'phone' => $enable_phone,
					'date' => $enable_date,
					//'header_image' => $picture,
					'description' => $this->input->post('description')
					);
            }
            $this->Reminder_model->addReminder($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/Reminder_letter/index');
            // redirect('admin/certificate/edit/' . $this->input->post('id'));
        }
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('reminder_letter', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Certificate List';
        $this->reminder_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/certificate/index');
    }

    public function view() {
        $id = $this->input->post('certificateid');
        $output = '';
        $data = array();

        $data['certificate'] = $this->reminder_model->certifiatebyid($id);
        $preview = $this->load->view('admin/certificate/preview_certificate', $data, true);
        echo $preview;
    }

    public function view1() {

        $id = $this->input->post('certificateid');
        $output = '';
        $certificate = $this->reminder_model->certifiatebyid($id);
        ?>
        <style type="text/css">
            body{ font-family: 'arial';}
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tc-container tr td{vertical-align: bottom;}
        </style>
        <div class="tc-container">
            <img src="<?php echo base_url('uploads/certificate/') ?><?php echo $certificate->background_image; ?>" width="100%" height="100%" />
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->enable_image_height; ?>px">
                    <td  valign="top" style="position: absolute;right: 0;">
                        <?php if ($certificate->enable_student_image == 1) { ?>
                            <img src="<?php echo base_url('uploads/certificate/noimage.jpg') ?>" width="100" height="auto">
                        <?php } ?>
                    </td>
                </tr>
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->header_height; ?>px">
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:left;position:relative;"><?php echo $certificate->left_header; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:center; position:relative; "><?php echo $certificate->center_header; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size: 18px; text-align:right;position:relative;"><?php echo $certificate->right_header; ?></td>
                </tr>
                <tr style="position:absolute;margin-left: auto;margin-right: auto;left: 0;right: 0; width:<?php echo $certificate->content_width; ?>px; display: block; top:<?php echo $certificate->content_height; ?>px;">
                    <td colspan="3" valign="top" align="center"><p style="font-size: 16px;position: relative;text-align:center; margin:0 auto; width: 100%; left:auto; right:0;"><?php echo $certificate->certificate_text; ?></p>
                    </td>
                </tr>
                <tr style="position:absolute; margin-left: auto;margin-right: auto;left: 0;right: 0;  width:<?php echo $certificate->content_width; ?>px; top:<?php echo $certificate->footer_height; ?>px">
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px; font-size:18px;text-align:left;"><?php echo $certificate->left_footer; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px; font-size:18px;text-align:center;"><?php echo $certificate->center_footer; ?></td>
                    <td valign="top" style="width:<?php echo $certificate->content_width; ?>px;font-size:18px;text-align:right;"><?php echo $certificate->right_footer; ?></td>
                </tr>
            </table>
        </div>
        <?php
    }

}
?>