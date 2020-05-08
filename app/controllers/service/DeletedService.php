<?php

class DeletedService extends Controller implements ServiceState{

  public function stateChange($service){
    $this->delete($service);
  }

  public function delete($service){
    //delete relavent record in db @avishka
  }
}
