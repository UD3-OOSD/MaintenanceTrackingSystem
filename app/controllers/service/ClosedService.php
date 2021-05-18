<?php

class ClosedService implements ServiceState{

  private static $closedservice = NULL;
  private static $ServiceActiveModel;

  private function __construct(){
      ClosedService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(ClosedService::$closedservice)){
      ClosedService::$closedservice = new ClosedService();
    }
    return ClosedService::$closedservice;
  }

  public function saveState($id){
      //Devin               ????????????????????????????
      $this->delete($id);
  }

  public function stateChange($service){
      $service->setState('8');
      ClosedLabour::$ServiceActiveModel->stateChange(Service::getId(),8);
      $this->delete($service);

  }

  public function delete($id){
    // @devin same soft delete function
    ClosedService::$ServiceActiveModel->delete($id,'ServiceId');
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
