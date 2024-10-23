<?php

class  TaskModel {

    private $jsonFile = ROOT_PATH . '/app/models/data.json';


    public function readTasks(){
        $tasks = file_exists($this->jsonFile) ? json_decode(file_get_contents($this->jsonFile), true) : [];
        return $tasks;
    }

    public function getTaskById($id){
        foreach($this->readTasks() as $task){
            if($task['id'] == $id){
                return $task;
            }
        }
    }

    public function updateTask(string $id, string $user, string $title, string $status, string $start_date, string $end_date): bool{
        $tasks = $this->readTasks();
        $oldTask = $this->getTaskById($id);
        
        if(!$oldTask) {
            return false;
        }
        $updateTask = [
            'id' => $id,
            'user' => $user,
            'title' => $title,
            'status' => $status,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        $key = array_search($oldTask, $tasks);

        if ($key !== false) {
            $tasks[$key] = $updateTask;
        }
        if(file_put_contents($this->jsonFile, json_encode($tasks, JSON_PRETTY_PRINT)) === false) {
            return false;
        }
        return true;
        }
    
    public function deleteTask($id): bool {
        $tasks = $this->readTasks();
        $originalCount = count($tasks);

        foreach ($tasks as $index => $task) {
            if ($task['id'] == $id) {
                unset($tasks[$index]);
                break;
            }
        }
        $tasks = array_values($tasks);
        file_put_contents($this->jsonFile, json_encode($tasks, JSON_PRETTY_PRINT));
        $newCount = count($tasks);
        return $originalCount > $newCount;
    }

    function replaceInArray(&$array, $oldTask, $updatedTask) {
        $key = array_search($oldTask, $array);
        if ($key !== false) {
            $array[$key] = $updatedTask;
        }
    }

    public function getNextId(): int {
        if (!file_exists($this->jsonFile) || empty($this->readTasks())) {
            return 1;
        }
        $lastTask = end($this->readTasks());
        return $lastTask['id'] + 1;
    }

}