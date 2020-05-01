<?php

class ApprovedService extends Controller implements ServiceState{

  public function stateChange($service){
    if(!$service->get_time_trigger()){
      if($service->get_trigger){
        $service->setState(new DeletedService());
      }else{
        $service->setState(new StartedService());
      }
    }else{
      $service->setState(new ExpiredService());
    }
  }


}
