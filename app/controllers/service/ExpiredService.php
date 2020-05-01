<?php

class ExpiredService extends Controller implements ServiceState{

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(new DeletedService());
    }else{
      $service->setState(new InitService());
      $this->delete_data($service);
    }
  }

  public function delete_data($service){
    // delete date from form @devin @uda
  }
}
