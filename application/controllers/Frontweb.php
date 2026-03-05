<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Frontweb extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function web_link()
    {
        if (!$this->rbac->hasPrivilege('add_webs_links', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/web-link');
        $data['title']        = 'Webs Links';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/websLinks', $data);
        $this->load->view('layout/footer', $data);
    }
    public function sub_link()
    {
        if (!$this->rbac->hasPrivilege('add_sub_links', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/sub-link');
        $data['title']        = 'Sub Links';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/subLinks', $data);
        $this->load->view('layout/footer', $data);
    }
    public function banner_image()
    {
        if (!$this->rbac->hasPrivilege('banner_image', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/banner-image');
        $data['title']        = 'Banner Image';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/bannerImage', $data);
        $this->load->view('layout/footer', $data);
    }
    public function gallery_image()
    {
        if (!$this->rbac->hasPrivilege('gallery_image', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/gallery-image');
        $data['title']        = 'Gallery Image';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/galleryImage', $data);
        $this->load->view('layout/footer', $data);
    }
    public function events()
    {
        if (!$this->rbac->hasPrivilege('events', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/events');
        $data['title']        = 'Events';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/events', $data);
        $this->load->view('layout/footer', $data);
    }
    public function new_updates()
    {
        if (!$this->rbac->hasPrivilege('new_updates', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Front Web');
        $this->session->set_userdata('sub_menu', 'frontweb/new-updates');
        $data['title']        = 'New Updates';
        $this->load->view('layout/header', $data);
        $this->load->view('frontweb/newUpdates', $data);
        $this->load->view('layout/footer', $data);
    }
}
