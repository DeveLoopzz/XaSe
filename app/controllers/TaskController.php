<?php

class TaskController {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function updateTask($id, $nombre, $estado, $fechaInicio, $fechaFin, $user){
        $task = $this->model->searchTask($id);
        if($task) {
            $this->model->updateTask($id, $nombre, $estado, $fechaInicio, $fechaFin, $user);
            exit();
        } else {
            echo "task not found";
        }
    }

}