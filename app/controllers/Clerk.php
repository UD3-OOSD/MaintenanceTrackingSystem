<?php

class Clerk extends Controller{

  public function indexAction(){
    $this->view->render('clerk/index');
  }
}
