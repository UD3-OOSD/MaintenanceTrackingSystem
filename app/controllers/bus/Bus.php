<?php

class Bus {

  private static $busses = [];
  private static $keys = ['Clerk','Admin'];
  private static $caller = '';
  //
  private static $bs, $_if = false;
  #private static $count = 0;
  //and some other attributes of bus .e.g. egine_numer, color....

  private static $bus = NULL;


  public static function getMultitance($key,$state){
      #dnd(!in_array($key,Bus::$keys));
    if(!in_array($key,Bus::$keys)){
      return null;
    }else{
      if(!in_array($key,Bus::$busses)){
        Bus::$busses[$key] = new Bus();
      }
      Bus::$caller = $key;
      Bus::setState($state);
      return Bus::$busses[$key];
    }
  }

  public function stateChange(){
    Bus::$bs->stateChange($this);
  }

  public static function setState($st){
    switch ($st){
        case "0":
            Bus::$bs = NewBus::getInstance();
            break;
        case '1':
            Bus::$bs = LockedBus::getInstance();
            break;
        case '2':
            Bus::$bs = EditingBus::getInstance();
            break;
        case '3':
            Bus::$bs = ClosedBus::getInstance();
            break;
    }
    //dnd(Bus::$bs);
  }

  public function getState(){
    return Bus::$bs;
  }

  public function get_trigger(){
    return Bus::$_if;
  }

  public function set_trigger(){
      Bus::$_if = true;
  }

  public function reset_trigger(){
      Bus::$_if = false;
  }

  public function showData($id){
    $details = Bus::$bs->show($id);
    $this->setState($details['BusState']);
    return $details;
    //this will feed the bus data table accoring to it's bus_id. @uda

  }


  public function setAttr($params){
    // here feeds $mtns to page @uda.
  }

  #function added by @devin for updating distance if wrong please rectify
  public function updatedistance($params){
      Bus::$bs->stateChange();
      Bus::$bs->updateDistance($params);
  }


  function fillAction($params){
        // TODO: Implement fillAction() method.
  }
}
