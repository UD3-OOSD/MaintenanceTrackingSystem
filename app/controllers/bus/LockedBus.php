<?php

require_once(ROOT.DS.'app/controllers/bus/BusState.php');


class LockedBus extends Controller implements BusState{

  public function stateChange($bus){
    if($bus->get_trigger()){
      $bus->setState(new EditingBus());
    }else{
      $bus->setState(new ClosedBus());
    }
  }

  //show method
  public function feed(){

  }

    public function updateDistance($params)
    {
        // TODO: Implement updateDistance() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}
