<?php

class FinishedService extends Controller implements ServiceState{

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

}
