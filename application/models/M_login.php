<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_login extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // Get User
    function getUser($username)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        // $this->db->where('password', $password);
        return $this->db->get()->result();
    }

    // Get User Daftar


    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function validateEmail($email)
    {
        $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function updatePasswordhash($data, $email)
    {
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    function getHahsDetails($hash)
    {
        $query = $this->db->query("SELECT * FROM users WHERE hash_key='$hash'");
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function validateHashString($hash)
    {
        $query = $this->db->query("SELECT * FROM users WHERE hash_key='$hash'");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function updateNewPassword($data, $hash)
    {
        $this->db->where('hash_key', $hash);
        $this->db->update('users', $data);
    }
}
