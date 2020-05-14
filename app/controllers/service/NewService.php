<?php

class NewService extends Controller implements ServiceState{

  public function __construct($service,$data){
    $this->settingAttributes($service);
    $this->fillAction($data);
    $this->load_model('ServiceActive');
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(new ApprovedService());
    }else{
      $service->setState(new InitService());
    }
  }
  public function settingAttributes($service){

  }

  public function fillAction($data){
      $this->ServiceActiveModel->registerNewService($data);
      #sets the data in table


  }


}
