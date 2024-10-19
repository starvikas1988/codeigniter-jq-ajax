<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Fetch all users
    public function get_users() {
        return $this->db->get('users')->result_array();
    }


    // Insert new user
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    // Update user details
    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    // Delete a user
    public function delete_user($id) {
        return $this->db->where('id', $id)->delete('users');
    }

    // Get a specific user by ID
    public function get_user_by_id($id) {
        return $this->db->where('id', $id)->get('users')->row_array();
    }
}
