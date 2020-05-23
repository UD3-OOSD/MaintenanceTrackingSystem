<?php

require_once(ROOT.DS.'app/controllers/bus/BusState.php');


class LockedBus  implements BusState{

  private static $lockedbus = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(LockedBus::$lockedbus)){
      LockedBus::$lockedbus = new LockedBus();
    }
    return LockedBus::$lockedbus;
  }

  public function stateChange($bus){
    if($bus->get_trigger()){
      $bus->setState(EditingBus::getInstance());
    }else{
      $bus->setState(ClosedBus::getInstance());
    }
  }

  public function fitAction($bus_num){
    //edit the bus data field -> goto BusModel.
    $bus_detail = $this->BusMEModel->findByBusNumber($bus_num);
    // at the end
    $this->stateChange($bus);  // turn into locked state.
    return $bus_detail;
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
