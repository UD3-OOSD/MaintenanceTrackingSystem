<?php

class NewBus extends Controller implements BusState{

  public function __construct($fields){
    $this->fillAction($fields);
  }

  public function stateChange($bus){
    $bus->setState(new EdittingBus());
  }

  public function fillAction($fields){
    //create a record and fill it.-> goto BusModel.
  }
}
