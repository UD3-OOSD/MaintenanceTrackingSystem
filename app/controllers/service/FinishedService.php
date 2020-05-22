<?php

class FinishedService implements ServiceState{

  private static $finservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(FinishedService::$finservice)){
      FinishedService::$finservice = new FinishedService();
    }
    return FinishedService::$finservice;
  }

  public function stateChange($service){
    if(!$service->get_trigger){
      $service->setState(ClosedService::getInstance());
    }// if service is not good then ? @nipun.
  }

    public function getState()
    {
        // TODO: Implement getState() method.
    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }
}
