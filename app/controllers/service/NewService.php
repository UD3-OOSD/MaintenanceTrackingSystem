<?php

class NewService implements ServiceState{

  private static $newservice = NULL;
  private static $ServiceActiveModel;
  private static $ServiceMatricsModel;

  private function __construct(){
      NewService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
      NewService::$ServiceMatricsModel = ModelCommon::loading_model('ServiceMatrics');
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
      NewService::$ServiceActiveModel->stateChange($service->getId(),3);
    }else{
      $service->setState('1');
      NewService::$ServiceActiveModel->stateChange($service->getId(),1);
    }
  }


  public function fillAction($params){
      //@devin : check this out.
      NewService::$ServiceActiveModel->registerNewService($params);
      if(isset($params['Labourers'])){
          NewService::$ServiceMatricsModel->addService($params);
      }

  }

  public function allServicesByState($state)
  {
      NewService::$ServiceActiveModel->allServicesByState($state);
      // TODO: Implement allServicesByState() method.
  }

  public function edit($service, $data){
        // TODO: Implement edit() method Add Error.
  }

  public function show($id){
      return ObjecttoArray(NewService::$ServiceActiveModel->findByServiceId($id));
  }
}
