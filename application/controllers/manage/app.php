<?php

class App extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('App_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    //App Manage List
    function index()
    {
        $username = $this->session->userdata('username');
        if( ! $username)
        {
            redirect(site_url('manage/login'));
            return;
        }

        $data['username'] = $username;
        $data['apps'] = $this->App_model->get_all();

        $this->load->view('manage/app_list_view', $data);
    }

    //App Add
    function add()
    {
        $username = $this->session->userdata('username');
        if( ! $username)
        {
            redirect(site_url('manage/login'));
            return;
        }

        $data['username'] = $username;
        $this->load->view('manage/app_add_view', $data); 
    }
    
    //add form action
    function do_add()
    {
        if($_FILES['iconfile']['size'] > 0)
        {
            $this->load->helper('string');

            $config['upload_path'] = './assets/images/appicon/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = random_string('alnum', 15).random_string('alnum', 15);

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('iconfile'))
            {
                $error = array('error' => $this->upload->display_errors());
       
                foreach($error as $item=>$value)
                {
                    echo $item.': '.$value;
                }

                echo '<p><a href="'.site_url('manage/app/add').'">Retry</a></p>';

                return;
            } 

            $res = $this->upload->data();
            $file_final_name = $res['file_name'];
        }

        //save to database;
        //$this->load->model('App_model');
        if(isset($file_final_name))
        {
            $this->App_model->insert($file_final_name);
        }
        else
        {
            $this->App_model->insert();
        }

        redirect(site_url('manage/app'));
    }

    //App Remove
    function delete($id = 0)
    {
        if($id == 0)
        {
            redirect(site_url('manage/app'));
        }

        $this->App_model->delete_by_id($id);

        redirect(site_url('manage/app'));
    }

    //App Edit
    function edit($id = 0)
    {
        $username = $this->session->userdata('username');
        if( ! $username)
        {
            redirect(site_url('manage/login'));
            return;
        }

        if ($id == 0) 
        {
            redirect(site_url('manage/app'));
        }
        
        $data = $this->App_model->get_by_id($id);
        $data = $data[0];
        $data->username = $username;

        $this->load->view('manage/app_edit_view', $data);
    }

    function do_edit()
    {
        if($_FILES['iconfile']['size'] > 0)
        {
            $this->load->helper('string');

            $config['upload_path'] = './assets/images/appicon/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = random_string('alnum', 15).random_string('alnum', 15);

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('iconfile'))
            {
                $error = array('error' => $this->upload->display_errors());
       
                foreach($error as $item=>$value)
                {
                    echo $item.': '.$value;
                }

                echo '<p><a href="'.site_url('manage/app/edit'.$_POST['id']).'">Retry</a></p>';

                return;
            } 

            $res = $this->upload->data();
            $file_final_name = $res['file_name'];
        }

        //save to database;
        //$this->load->model('App_model');
        //todo: delete the old img
        if(isset($file_final_name))
        {
            $this->App_model->update_by_id($file_final_name);
        }
        else
        {
            $this->App_model->update_by_id($_POST['old_icon_addr']);
        }

        redirect(site_url('manage/app'));
    }

}

/* app.php end */
