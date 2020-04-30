<?php

class EdittingBus extends Controller implements BusState{

  public function stateChange($bus){
    $bus->setState(new LockedBus());
  }

  public function fitAction($bus,$attr){
    //edit the bus data field -> goto BusModel.

    // at the end
    $bus->setState(new LockedBus());  // turn into locked state.
  }

  public function updateDistance($dis){
    //update attribute and deal with db @avishka.

    //check for service.@avishka

    //$arr = $this->check($dis);

    //if(!empty($arr)){
    // $this->addService($data);
    //}
  }

  public function check($data){
    //check for availible all services - @devin , @avishka
    // return arr[]
  }

  public function addService($data = []){
    //here create a new service.
    //***** by SYSTEM or FORMAN
    // but forman send empty request @uda , @devin

    // update db @avishka.
  }



}
