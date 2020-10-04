<?php

class StartedService implements ServiceState{

  private static $stservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(StartedService::$stservice)){
      StartedService::$stservice = new StartedService();
    }
    return StartedService::$stservice;
  }

  public function stateChange($service){
    $service->setState('5');
    $this->ServiceActiveModel->stateChange($service->getId(),5);
  }

    public function getState()
    {
        // TODO: Implement getState() method.
    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}
