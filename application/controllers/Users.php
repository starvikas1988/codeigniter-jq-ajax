<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {



    public function __construct() {
        parent::__construct();
        $this->load->database();  // This automatically initializes $this->db
        $this->load->model('User_model');
        $this->load->helper('url');
        
    }

    // Load the main view
    public function index() {
        $this->load->view('users_view');
    }

    public function post_user_data(){
       echo  $name =  $this->input->post('name');
        echo $email =  $this->input->post('email');
        exit();
        $data = array(
            'name'=>$name,
            'email'=>$email
        );

        $this->User_model->insert_user($data);

        echo json_encode(array('status' => 'success'));
    }
    // Fetch all users (AJAX)
    public function fetch_users() {
        $data = $this->User_model->get_users();
        echo json_encode($data);
    }

    // Insert a new user (AJAX)
    public function add_user() {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $data = array(
            'name' => $name,
            'email' => $email
        );
        $this->User_model->insert_user($data);
        echo json_encode(array("status" => "success"));
    }

    // Update an existing user (AJAX)
    public function update_user() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $data = array(
            'name' => $name,
            'email' => $email
        );
        $this->User_model->update_user($id, $data);
        echo json_encode(array("status" => "success"));
    }

    // Delete a user (AJAX)
    public function delete_user() {
        $id = $this->input->post('id');
        $this->User_model->delete_user($id);
        echo json_encode(array("status" => "success"));
    }

    // Get a user by ID (AJAX)
    public function get_user_by_id() {
        $id = $this->input->post('id');
        $data = $this->User_model->get_user_by_id($id);
        echo json_encode($data);
    }
}
