<?php
 class Users_Model extends CI_Model{
   public function add_user($user){
     $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
               VALUES (?, ?, ?, ?, NOW(), NOW())";
     $values = array($user['first_name'], $user['last_name'], $user['email'], $user['password']);
     return $this->db->query($query, $values);
   }

   public function login_user($email){
     $query = "SELECT * FROM users WHERE email = ?";

     return $this->db->query($query, array($email))->row_array();
   }
 }
 ?>
