<?php

require_once(ROOT.DS.'app'.DS.'controllers'.DS.'bus'.DS.'BusState.php');


class NewBus extends Controller implements BusState{

  private static $closedbus = NULL;

  private function __construct(){
    $this->load_model('BusMS');
    $this->load_model('BusME');
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
    $this->BusMEModel->NewDistanceTravelledRow($params['BusNumber'],$params['Mileage']);

        #Router::redirect('admin');  #will have to change
  }
    //create a record and fill it.-> goto BusModel.


  public function updateDistance($params){
    echo('Error');
  }

  public function show($id){
    echo('Error');
  }

}
