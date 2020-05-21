<?php

class ExpiredService extends Controller implements ServiceState{

  private static $expservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ExpiredService::$expservice)){
      ExpiredService::$expservice = new ExpiredService();
    }
    return ExpiredService::$expservice;
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(DeletedService::getInstance());
    }else{
      $service->setState(InitService::getInstance());
      $this->delete_data($service);
    }
  }

  public function delete_data($service){
    // delete date from form @devin @uda
  }
}
