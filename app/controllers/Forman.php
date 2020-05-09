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

  public function acceptedAction(){
    #fetch data from busdb for accepted services and their headers. @devin @avishka.
    $heads = ['bus id','service id','service category'];
    $lis = [[001,156,'Engine'],[002,225,'tires'],[003,063,'Full service']];
    $links = ['index','',''];
    $this->view->table_1 = displaylinkedtable($heads,$lis,$links);
    $this->view->render('forman/accepted');
  }

  public function showAction($id){
    //fetch data by model on $id @devin. => $data;

  }


  // show tables @nipun.


}
