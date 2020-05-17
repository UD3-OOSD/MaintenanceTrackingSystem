<?php

class Clerk extends Controller{

  public function indexAction(){

    $validation = new Validate();
    $posted_values = [];
    if($_POST){
      $validation->check($_POST,[]);
      $posted_values = posted_values($_POST);
      if($validation->passed()){
        $posted_values = []; //this will reset the array to show empty boxs.
      }
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('clerk/index');
  }

  public function updateAction($data){  // connect to update button @uda
    $this->getState()->stateChange();
    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka

  }
}
