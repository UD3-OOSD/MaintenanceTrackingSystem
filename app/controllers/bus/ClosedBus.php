<?php

require_once(ROOT.DS.'app/controllers/bus/BusState.php');


class ClosedBus  implements BusState{

  private static $closedbus = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ClosedBus::$closedbus)){
      ClosedBus::$closedbus = new ClosedBus();
    }
    return ClosedBus::$closedbus;
  }
  
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
