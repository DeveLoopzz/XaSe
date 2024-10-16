<?php

class TaskController extends Controller{

    private $model;

    public function __construct(){
        $this->model = new TaskModel();
    }

    public function indexAction(){
    
    }

    public function createAction(){

    }
    
    public function addAction(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = $_POST['user'] ?? '';
            $title = $_POST['title'] ?? '';
            $status = $_POST['status'] ?? '';
            $start_date = $_POST['start_date'] ?? '';
            $end_date = $_POST['end_date'] ?? '';
        }

        $result = $this->model->addTask($user, $title, $status, $start_date, $end_date);

        if(!$result){
            echo 'Error saving task.';
            exit;
        } else {
            header("Location:" . WEB_ROOT . "/success");
        }

    }

    public function readAction(){
        
        $tasks = $this->model->readTask();
        
        $this->view->tasks = $tasks;
        
    }

    public function successAction(){

    }
}