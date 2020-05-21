<?php

class StartedService extends Controller implements ServiceState{

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
    $service->setState(FinishedService::getInstance());
  }

}
