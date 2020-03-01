<?php

class User_model extends CI_Model
{

    public function getUser()
    {
        return $this->db->get('tb_user');
    }
}
