<?php
  class Messages_Model extends CI_Model{
    public function get_todos($id){
      return $this->db->query("SELECT * FROM todos
                      WHERE completed = 0 AND user_id = $id
                      ")->result_array();
    }

    public function get_complete_todos($id){
      return $this->db->query("SELECT * FROM todos
                        WHERE completed = 1 AND user_id = $id
                        ")->result_array();
    }

    public function add_todo($todo_info){
      $query = "INSERT INTO todos (title, when_at, completed, created_at, updated_at, user_id)
                VALUES (?, ?, 0, NOW(), NOW(), ?)";
      $values = array($todo_info['title'], $todo_info['when_at'], $todo_info['user_id']);

      $this->db->query($query, $values);
    }

    // public function delete_todo($id){
    //   $query = "DELETE FROM todos WHERE id = ?";
    //   $values = $id;
    //   $this->db->query($query, $values);
    // }
  }
 ?>
