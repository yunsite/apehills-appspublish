<?php 

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    function index()
    {
        if($this->session->userdata('username'))
        {
            redirect(site_url('manage/app'));
        }
        else
        {
            $this->load->view('manage/login_view');
        }
    }

    function check()
    {
        $un = $_POST['username'];
        $pwd = $_POST['password'];

        $res = $this->User_model->check($un, $pwd);

        if( ! $res)
        {
            redirect(site_url('manage/login'));
        }
        else
        {
            $this->session->set_userdata('username', $res); 
            redirect(site_url('manage/app'));
        }
    }

}

/* end of login.php */
