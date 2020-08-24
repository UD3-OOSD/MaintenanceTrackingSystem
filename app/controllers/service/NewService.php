<?php

class NewService implements ServiceState{

  private static $newservice = NULL;
  private static $ServiceActiveModel;

  private function __construct(){
      NewService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(NewService::$newservice)){
      NewService::$newservice = new NewService();
    }
    return NewService::$newservice;
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState('3');
        $this->ServiceActiveModel->stateChange($service->ServiceId,3);
    }else{
      $service->setState('1');
      $this->ServiceActiveModel->stateChange($service->ServiceId,1);
    }
  }


  public function fillAction($params){
      //@devin : check this out.
      $this->ServiceActiveModel->registerNewService($params);

  }

  public function allServicesByState($state)
  {
      $this->ServiceActiveModel->allServicesByState($state);
      // TODO: Implement allServicesByState() method.
  }

  public function edit($service, $data){
        // TODO: Implement edit() method Add Error.
  }

  public function show($id){
      return ObjecttoArray(NewService::$ServiceActiveModel->findByServiceId($id));
  }
}
