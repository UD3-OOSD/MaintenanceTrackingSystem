<?php

require_once(ROOT.DS.'app'.DS.'controllers'.DS.'bus'.DS.'BusState.php');


class NewBus  implements BusState{

  private static $newbus = NULL;
    private $BusMSModel;
    private $BusMEModel;

    private function __construct(){
      $this->BusMSModel = ModelCommon::loading_model('BusMS');
      $this->BusMEModel = ModelCommon::loading_model('BusME');
  }

  public static function getInstance(){
    if(!isset(NewBus::$newbus)){
      NewBus::$newbus = new NewBus();
    }
    return NewBus::$newbus;
  }

  public function stateChange($bus){
    $bus->setState(LockedBus::getInstance());
  }

  public function fillAction($params){
    $this->BusMSModel->registerNewBus($params);
    #echo($params['Mileage']);
    #dnd('_____________');
    $this->BusMEModel->NewBusDistanceUpdate($params['BusNumber'],$params['Mileage']);

        #Router::redirect('admin');  #will have to change
  }
    //create a record and fill it.-> goto BusModel.


  public function updateDistance($params){
    echo('Error');
  }

  public function show($id){
      return ObjecttoArray($this->BusMSModel->findByBusNumber($id));
  }

}
