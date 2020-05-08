<?php

class LockedBus extends Controller implements BusState{

  public function stateChange($bus){
    if($bus->get_trigger()){
      $bus->setState(new EdittingBus());
    }else{
      $bus->setState(new ClosedBus());
    }
  }

  //show method
  public function feed(){

  }
}
