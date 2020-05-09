<?php

class Clerk extends Controller{

  public function indexAction(){
    $this->view->render('clerk/index');
  }

  public function updateAction($data){  // connect to update button @uda
    $this->getState()->stateChange();
    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka

  }
}
