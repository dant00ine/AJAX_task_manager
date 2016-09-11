<?php
  class Comments extends CI_Controller{
    public function add_comment(){
      $this->load->model('comments_model');

      $comment_info = array(
        'user_id' => $this->session->userdata['user']['id'],
        'message_id' => $this->input->post('message_id'),
        'comment' => $this->input->post('comment')
      );

      $this->comments_model->add_comment($comment_info);

      redirect(base_url('messages'));
    }

    public function delete_comment($id){
      $this->load->model('comments_model');

      $this->comments_model->delete_comment($id);

      redirect(base_url('messages'));
    }
  }
 ?>
