<?php

class ClosedService implements ServiceState{

  private static $closedservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ClosedService::$closedservice)){
      ClosedService::$closedservice = new ClosedService();
    }
    return ClosedService::$closedservice;
  }

  public function stateChange($service){
    $this->delete($service);
  }

  public function delete($service){
    // delete relevent records @avishka, @devin
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
