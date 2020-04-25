<?php

class Admin extends Controller{

  public function indexAction(){
    $this->view->render('admin/index');
  }
}
