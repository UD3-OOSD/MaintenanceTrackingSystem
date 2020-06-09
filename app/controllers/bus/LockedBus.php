<?php


class LockedBus  implements BusState{

  private static $lockedbus = NULL;

  private static $BusMEModel;

    private function __construct(){
      LockedBus::$BusMEModel = ModelCommon::loading_model('BusME');

  }

  public static function getInstance(){
    if(!isset(LockedBus::$lockedbus)){
      LockedBus::$lockedbus = new LockedBus();
    }
    return LockedBus::$lockedbus;
  }

  public function stateChange($bus){
      //dnd($bus);
    if($bus->get_trigger()){
      $bus->setState('3');

    }else{
      $bus->setState('2');
        //dnd($bus);
    }
  }

  public function fitAction($bus_num){
    //edit the bus data field -> goto BusModel.
    $bus_detail = LockedBus::$BusMEModel->findByBusNumber($bus_num);
    // at the end
    //$this->stateChange($bus);  // turn into locked state.
    return $bus_detail;
  }

  //show method
  public function feed(){

  }

    public function checkId($id){
        //@devin
        #dnd(LockedBus::$BusMEModel->isBusNumberValid(   $id));
        return LockedBus::$BusMEModel->isBusNumberValid($id);
    }

  public function updateDistance($BusNumber,$Distance)
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
