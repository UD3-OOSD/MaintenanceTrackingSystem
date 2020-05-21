<?php

require_once(ROOT.DS.'app/controllers/bus/BusState.php');


class ClosedBus extends Controller implements BusState{
  public function stateChange($bus){
    //no idea about state change @devin
    $this->delete();  // like
  }

  public function delete(){ // or can call directly to Model @avishka.
    //delete from $bussess with related services but not all. @avishka
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
