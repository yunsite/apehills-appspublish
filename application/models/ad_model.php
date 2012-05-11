<?php

class Ad_model extends CI_Model {

    var $name = '';
    var $des = '';
    var $pic_addr = 'default.png';
    var $link_addr = NULL;
    var $position = 1;
    var $is_show = 1;

    function __construct()
    {
        parent::__construct(); 
    }

    function get_all()
    {
        $this->db->order_by('position', 'desc');
        $query = $this->db->get('ad'); 
        
        return $query->result();
    }

    function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('ad');

        return $query->result();
    }

    function update_by_id($pic_addr)
    {
        $this->id = $_POST['id'];
        $this->name = $_POST['name']; 
        $this->pic_addr = $pic_addr;

        if( isset($_POST['des']) )
        {
            $this->des = $_POST['des'];
        }
        if( isset($_POST['link_addr']) )
        {
            $this->link_addr = $_POST['link_addr'];
        }
        if( isset($_POST['position']) )
        {
            $this->position = $_POST['position'];
        }
        if( isset($_POST['is_show']) )
        {
            $this->is_show = $_POST['is_show'];
        }

        $this->db->where('id', $_POST['id']);
        $this->db->update('ad', $this);
    }

    function delete_by_id($id)
    {
        $this->db->where('id', $id); 
        $this->db->delete('ad');
    }

    function insert($pic_addr = 'default.png')
    {
        $this->name = $_POST['name']; 
        $this->pic_addr = $pic_addr;

        if( isset($_POST['des']) )
        {
            $this->des = $_POST['des'];
        }
        if( isset($icon_addr) )
        {
            $this->icon_addr = $icon_addr;
        }
        if( isset($_POST['link_addr']) )
        {
            $this->link_addr = $_POST['link_addr'];
        }
        if( isset($_POST['position']) )
        {
            $this->position = $_POST['position'];
        }
        if( isset($_POST['is_show']) )
        {
            $this->is_show = $_POST['is_show'];
        }

        $this->db->insert('ad', $this);
    }

}

/* end of ad_model.php */

