<?php
  class Todos extends CI_Controller {

    public function __contruct(){
      parent::__construct();
      $this->load->model('todos_model');
    }

    public function index(){
      $this->load->view('task_view');
    }

    public function add_todo(){
      $this->load->model('todos_model');
      $todo_info = array(
        'user_id' => $this->session->userdata['user']['id'],
        'title' => $this->input->post('title'),
        'when_at' => $this->input->post('when_at')
      );

      $this->todos_model->add_todo($todo_info);
      $data['todos'] = $this->todos_model->get_todos();
      echo json_encode($data);
    }

    public function update_status($id){
      $this->load->model('todos_model');

      $completed = $this->input->post('completed');

      if($completed == 0){
        $data = $this->todos_model->complete($id);
        echo json_encode($data);
      } else {
        $data = $this->todos_model->incomplete($id);
        echo json_encode($data);
      }
    }

    public function generate_todos($id){

      $this->load->model('todos_model');

      $data['todos'] = $this->todos_model->get_todos($id);
      $data['complete_todos'] = $this->todos_model->get_complete_todos($id);

      echo json_encode($data);

    }
  }
 ?>
