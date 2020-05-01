<?php

class StartedService extends Controller implements ServiceState{

  public function stateChange($service){
    $service->setState(new FinishedService());
  }

}
