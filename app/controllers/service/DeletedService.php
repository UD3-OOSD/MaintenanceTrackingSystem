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

  public function saveState($id){
      //@devin
      // save state as '8' in $id
      $this->delete($id);
  }

  public function delete($service){
    //@devin soft delete.
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
