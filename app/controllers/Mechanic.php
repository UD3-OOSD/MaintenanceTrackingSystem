<?php

class Mechanic extends Controller{

    private $service,$_init,$_started;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
    $this->load_system('SysteemService');
  }

  public function indexAction(){

    //display tables
    [$this->_init,$this->_started] = $this->SystemService->get();
    $this->view->render('mechanic/index');
  }

  public function startService($id){
      $var = $this->SystemService->check();
      if($var){
          $this->service = $var;
          $this->service->stateChange($this);
      }else{
          echo $id." is not valid.";
          Router::redirect('mechanic');
      }
      //display page
      $this->view->render('mechanic');
  }

}
