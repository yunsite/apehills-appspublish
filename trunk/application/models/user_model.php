<?php

class User_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($un, $pwd)
    {
        $data['username'] = $un;
        $data['pwd'] = md5($pwd . 'ApeHills');

        $this->db->insert('user', $data);
    }

    function check($un, $pwd)
    {
        $pwd = md5($pwd . 'ApeHills'); 

        $this->db->where('username', $un);
        $this->db->where('pwd', $pwd);
        $query = $this->db->get('user');

        $result = $query->result();
        $count = count($result);
        if($count > 0)
        {
            return $result[0]->username;
        }
        else
        {
            return FALSE;
        }
    }
}

/* end of user_model.php */
