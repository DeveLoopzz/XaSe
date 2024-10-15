<?php

class  TaskModel {

    private $filepath = __DIR__ . '/../data/data.json';

    public function loadTasks() {
        $data = file_get_contents($this->filepath);
        return json_decode($data, true); 
    }

    public function searchTask($id) {
        $datajson = $this->loadTasks();
        $tasks = $datajson['tareas'];
        foreach($tasks as $task) {
            if($task['id'] == $id) {
                return $task;
            }
        }
        return null;
    }

    
    public function updateTask($id, $nombre, $estado, $fechaInicio, $fechaFin, $user) {
        $datajson = $this->loadTasks();
        $tasks = $datajson['tareas'];

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['nombre'] = $nombre;
                $task['estado'] = $estado;
                $task['fechaInicio'] = $fechaInicio;
                $task['fechaFin'] = $fechaFin;
                $task['user'] = $user;
                break;
            }
        }
        file_put_contents($this->filepath, json_encode($tasks, JSON_PRETTY_PRINT));
        }

    public function deleteTask($id) {
        $datajson = $this->loadTasks();
        $tasks = $datajson['tareas'];
        foreach($tasks as $index => $value) {
            if($value['id'] == $id) {
                unset($tasks[$index]);
                 break;
            }
        }
        $tasks = array_values($tasks);
        $datajson['tareas'] = $tasks;
        file_put_contents($this->filepath, json_encode($datajson, JSON_PRETTY_PRINT));
    }

}