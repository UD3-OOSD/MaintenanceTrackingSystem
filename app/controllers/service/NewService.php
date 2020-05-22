<?php

class NewService implements ServiceState{

  private static $newservice = NULL;

  private function __construct(){
      $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');

    $service->stateChange();
    $this->fillAction($data,$service->getState());
  }

  public static function getInstance(){
    if(!isset(NewService::$newservice)){
      NewService::$newservice = new NewService();
    }
    return NewService::$newservice;
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(ApprovedService::getInstance());
    }else{
      $service->setState(InitService::getInstance());
    }
  }


  public function getState()
  {
      // TODO: Implement getState() method.
      return('NewService');
  }


  public function fillAction($data,$state){
      $data=mergeData(['ServiceId'=> $state],$data);
      $this->ServiceActiveModel->registerNewService($data);
  }

  public function allServicesByState($state)
  {
      $this->ServiceActiveModel->allServicesByState($state);
      // TODO: Implement allServicesByState() method.
  }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method Add Error.
    }
}
