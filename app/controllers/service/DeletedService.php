<?php

class DeletedService implements ServiceState{

  private static $delservice = NULL;
  private static $ServiceActiveModel;
  private static $ServiceMatrixModel;

  private function __construct(){
      DeletedService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
      DeletedService::$ServiceMatrixModel = ModelCommon::loading_model('ServiceMatrics');
  }

  public static function getInstance(){
    if(!isset(DeletedService::$delservice)){
      DeletedService::$delservice = new DeletedService();
    }
    return DeletedService::$delservice;
  }

  public function stateChange($service){
    $this->delete($service);
    $this->ServiceActiveModel->stateChange($service->getId(),8);
  }

  public function saveState($id){
      DeletedService::$ServiceActiveModel->stateChange($id,8);
      //@devin
      // save state as '8' in $id
      $this->delete($id);
  }

  public function delete($service){
     DeletedService::$ServiceActiveModel->delete($service   ,'ServiceId');
     DeletedService::$ServiceMatrixModel->delete($service ,'ServiceId');
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

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}
