<?php
// ci_ajax_crud/
// ├── application/
// │   ├── controllers/
// │   │   └── Posts.php              # Updated controller with validation and file uploads
// │   ├── models/
// │   │   └── Post_model.php         # Updated model with image handling
// │   ├── views/
// │   │   └── posts/
// │   │       ├── index.php          # Updated view with pagination and image upload form
// │   │       └── create.php         # Create view for adding posts (loaded via AJAX)
// ├── assets/
// │   ├── js/
// │   │   └── custom.js              # Updated JavaScript for validation, file upload, and pagination
// │   ├── css/
// │   │   └── style.css              # CSS for styling the modals and pagination
// ├── uploads/                       # Directory for uploaded images
// ├── system/
// ├── index.php


defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{

    public function getPosts(){
        return $this->db->get('posts')->result_array();
    }

    public function insertPost($data){
        return $this->db->insert('posts',$data);
    }

    public function updatePost($id,$data){
        return $this->db->where('id',$id)->update('posts',$data);
    }

    public function deletePost($id){
        return $this->db->where('id',$id)->delete('posts');
    }

    public function getPostById($id){
        return $this->db->where('id',$id)->get('posts')->row_array();
    }
}
?>