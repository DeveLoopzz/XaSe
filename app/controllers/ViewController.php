<?php

class ViewController extends Controller{

    public function indexAction(){
        
        $this->view->render('../layouts/layout.phtml');
    }

    public function createAction(){
        
        $this->view->render('../layouts/layout.phtml'); 
    }

    public function readAction(){
        
        $this->view->render('../layouts/layout.phtml');
    }

}