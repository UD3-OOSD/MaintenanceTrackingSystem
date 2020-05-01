<?php

class Forman extends Controller{

  public function indexAction(){

    $this->view->render('forman/index');
  }

  public function approveAction(){
    //get service_id from url and fetch its' service obj. @avishka, @devin
    // $data by url.
    $service->getState()->edit($service,$data);
    $this->view->render('forman/index');
  }

  public function deleteAction(){
    //get service_id from url and fetch its' service obj. @avishka, @devin
    // $data by url.
    $service->stateChange();
    $this->view->render('forman/index');
  }

  // show tables @nipun.


}
