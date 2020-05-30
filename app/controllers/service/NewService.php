<?php

class NewService implements ServiceState{

  private static $newservice = NULL;
  private $ServiceActiveModel;

  private function __construct(){
      $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
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
        $this->ServiceActiveModel->stateChange($service->ServiceId,2);
    }else{
      $service->setState(InitService::getInstance());
      $this->ServiceActiveModel->stateChange($service->ServiceId,1);
    }
  }


  public function fillAction($data){
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
