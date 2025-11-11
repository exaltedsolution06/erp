<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ticket extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('ticket_list', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Ticket');
        $this->session->set_userdata('sub_menu', 'ticket/index');
        $data['title']        = 'Ticket List';
        $ticket_result      = $this->ticket_model->get();
        $data['ticketlist'] = $ticket_result;
        $this->load->view('layout/header', $data);
        $this->load->view('ticket/ticketList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('ticket_list', 'can_view')) {
            access_denied();
        }
        $data['title']    = 'Ticket List';
        $ticket         = $this->ticket_model->get($id);
        $data['ticket'] = $ticket;
        $this->load->view('layout/header', $data);
        $this->load->view('ticket/ticketShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('ticket_list', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Ticket List';
        $this->ticket_model->remove($id);
        $this->session->set_flashdata('msgdelete', '<div class="alert alert-success text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('ticket/index');
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('ticket_list', 'can_add')) {
            access_denied();
        }
        $data['title']        = 'Create Ticket';
        $ticket_result      = $this->ticket_model->get();
        $data['ticketlist'] = $ticket_result;
        $this->form_validation->set_rules('ticket', $this->lang->line('ticket'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('ticket/ticketList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'ticket' => $this->input->post('ticket'),
            );
            $this->ticket_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('ticket/index');
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('ticket_list', 'can_edit')) {
            access_denied();
        }
        $data['title']        = 'Edit Ticket';
        $ticket_result      = $this->ticket_model->get();
        $data['ticketlist'] = $ticket_result;
        $data['id']           = $id;
        $ticket             = $this->ticket_model->get($id);
        $data['ticket']     = $ticket;
        $this->form_validation->set_rules('ticket', $this->lang->line('ticket'), 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('ticket/ticketEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id'       => $id,
                'ticket' => $this->input->post('ticket'),
            );
            $this->ticket_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('ticket/index');
        }
    }

}
