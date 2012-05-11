<?php

class Product extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->model('Ad_model');
        $this->load->model('App_model');
    }

    function index($app = 'default')
    {
        //load ad data modal
        //load app data modal
        //load show tips data modal by $country, $device, $app
        //make up $data
        //select device specific view and render $data
        //output

        $data['ads'] = $this->Ad_model->get_all();
        $data['apps'] = $this->App_model->get_all();

        if($this->agent->is_mobile('iphone') OR $this->agent->is_mobile('ipad'))
        {
            $this->load->view('publish/mobile/iphone/product_view', $data);
        }
        else if($this->agent->is_mobile())
        {
            $this->load->view('publish/mobile/others/product_view', $data);
        }
        else
        {
            $this->load->view('publish/desktop/product_view', $data);
        }
    }



}

/* end of file */
