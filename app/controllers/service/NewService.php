<?php

class NewService extends Controller implements ServiceState{

  public function __construct($service,$data){
    $service->setAttrs($data);
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(new ApprovedService());
    }else{
      $service->setState(new InitService());
    }
  }


}
