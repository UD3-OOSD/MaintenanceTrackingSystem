<?php

require_once(ROOT.DS.'app/controllers/bus/NewBus.php');


class Bus {

  private $busses = [];
  private $keys = ['clerk','admin'];
  private $caller = '';
  //
  private $mtns ;
  private $bs, $_if = false;
  private static $count = 0;
  //and some other attributes of bus .e.g. egine_numer, color....

  private static $bus = NULL;

  private function __construct(){
    self::$count++;
    #$this->load_model('BusM'); // 'bus' is not sure .its' Maintainance details as well @avishka.
    $this->bs = NewBus::getInstance();
  }

  public static function getMultitance($key){
    if(!isset($keys[$key])){
      return null;
    }else{
      if(!isset($busses[$key])){
        $busses[$key] = new Bus();
      }
      $caller = $key;
      return $busses[$key];
    }
  }

  public function stateChange(){
    $this->bs->stateChange($this);
  }

  public function setState($st){
    $this->bs = $st;
  }

  public function getState(){
    return $this->bs;
  }

  public function get_trigger(){
    return $this->_if;
  }

  public function set_trigger(){
    $this->_if = true;
  }

  public function reset_trigger(){
    $this->_if = false;
  }

  public function showData($id){
    $details = $this->bs->show($id);
    $this->setState($details['BusState']);
    return $details;
    //this will feed the bus data table accoring to it's bus_id. @uda

  }
  public function fillAction($params){
    $params['BusId'] = 'Bus'.Bus::$count;
    #dnd($this->bs);
    $this->bs->fillAction($params);
  }

  public function setAttr($params){
    // here feeds $mtns to page @uda.
  }

  #function added by @devin for updating distance if wrong please rectify
  public function updatedistance($params){
    $this->bs->stateChange();
    $this->bs->updateDistance($params);
  }




}
