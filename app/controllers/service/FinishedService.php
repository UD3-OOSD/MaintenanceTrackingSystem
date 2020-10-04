<?php

class FinishedService implements ServiceState{

  private static $finservice = NULL;
    private static $ServiceActiveModel;

  private function __construct(){
      FinishedService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(FinishedService::$finservice)){
      FinishedService::$finservice = new FinishedService();
    }
    return FinishedService::$finservice;
  }

  public function stateChange($service){
      $service->setState('6');
      //dnd($this->ServiceActiveModel);
      //$this->ServiceActiveModel->stateChange($service->ServiceId,6);
      FinishedService::$ServiceActiveModel->stateChange($service->getId(),6);
    // if service is not good then ? @nipun.
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
    {   //not needed
        
        // TODO: Implement fillAction() method.
    }
}
