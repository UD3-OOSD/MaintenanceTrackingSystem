<?php

class DeletedService implements ServiceState{

  private static $delservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(DeletedService::$delservice)){
      DeletedService::$delservice = new DeletedService();
    }
    return DeletedService::$delservice;
  }

  public function stateChange($service){
    $this->delete($service);
  }

  public function delete($service){
    //delete relavent record in db @avishka
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
