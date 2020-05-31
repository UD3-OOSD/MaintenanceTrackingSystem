<?php

class Mechanic extends Controller{

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
  }

  public function indexAction(){
    $this->view->render('mechanic/index');
  }
}
