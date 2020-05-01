<?php

class FinishedService extends Controller implements ServiceState{

  public function stateChange($service){
    if(!$service->get_trigger){
      $service->setState(new ClosedService());
    }// if service is not good then ? @nipun.
  }

}
