<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class Posts extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Post_model');
         $this->load->helper('url');
         $this->load->database();
    }

    //load main view

    public function index(){
        $this->load->view('posts/index');
    }

    public function fetch_posts(){
        $data = $this->Post_model->getPosts();
        echo json_encode($data);
    }

    public function add_post(){
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        // Handle image upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;  // 2MB max
        $this->load->library('upload', $config);

        $image = '';
        if (!$this->upload->do_upload('image')) {
            $image = '';  // No image uploaded or error
        } else {
            $upload_data = $this->upload->data();
            $image = $upload_data['file_name'];  // Get uploaded file name
        }
        
        
        $data = array(
            'title' => $title,
            'content' => $content,
            'image' => $image
        );
       

        $this->Post_model->insertPost($data);

        echo json_encode(array('status'=>'success'));
    
    }

    public function get_post(){
        $id = $this->input->post('id');

        $data = $this->Post_model->getPostById($id);

        echo json_encode($data);
    }

       // Update post (AJAX)
    public function update_post() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
         // Handle image upload
         $config['upload_path'] = './uploads/';
         $config['allowed_types'] = 'jpg|jpeg|png|gif';
         $config['max_size'] = 2048;  // 2MB max
         $this->load->library('upload', $config);

         $image = $post['image'];  // Keep the old image if not changed
         if ($this->upload->do_upload('image')) {
             if (!empty($image) && file_exists('./uploads/' . $image)) {
                 unlink('./uploads/' . $image);  // Delete old image
             }
             $upload_data = $this->upload->data();
             $image = $upload_data['file_name'];
         }

        $data = array(
            'title' => $title,
            'content' => $content,
            'image' => $image
        );

        $this->Post_model->updatePost($id, $data);
        echo json_encode(array("status" => "success"));
    }

     // Delete post (AJAX)
     public function delete_post() {
         $id = $this->input->post('id');  // Ensure you're getting the correct POST data

        if($id) {
            $this->Post_model->deletePost($id);  // Call model to delete the post
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid ID'));
        }
    }
    

}
?>