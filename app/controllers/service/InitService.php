<?php

class InitService extends Controller implements ServiceState{

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(new ApprovedService());
    }else{
      $service->setState(new DeletedService());
    }
  }

  public function edit($service, $data){
    $service->setAttrs($data);
  }
}
