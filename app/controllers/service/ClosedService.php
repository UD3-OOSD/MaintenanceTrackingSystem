<?php

class ClosedService extends Controller implements ServiceState{

  public function stateChange($service){
    $this->delete($service);
  }

  public function delete($service){
    // delete relevent records @avishka, @devin
  }
}
