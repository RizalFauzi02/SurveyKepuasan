<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_superadmin extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_all_byOrder()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('tb_survey')->result();
    }
}
