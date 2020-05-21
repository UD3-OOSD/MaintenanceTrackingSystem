<?php

class DeletedService extends Controller implements ServiceState{

  private static $closedbus = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ClosedBus::$closedbus)){
      ClosedBus::$closedbus = new ClosedBus();
    }
    return ClosedBus::$closedbus;
  }

  public function stateChange($service){
    $this->delete($service);
  }

  public function delete($service){
    //delete relavent record in db @avishka
  }
}
