<?php

require_once(ROOT.DS.'app/controllers/bus/NewBus.php');


class Bus extends Controller{

    //
    private $mtns ;
    private $bs, $_if = false;
    private static $count = 0;
    //and some other attributes of bus .e.g. egine_numer, color....


    public function __construct(){
        Bus::$count++;
        #$this->load_model('BusM'); // 'bus' is not sure .its' Maintainance details as well @avishka.
        $bs = NewBus::getInstance();
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

    public function set_trigger($val){
      $this->_if = $val;
    }

    public function showData(){
      //this will feed the bus data table accoring to it's bus_id. @uda

    }
    public function fillAction($params){
      $params['BusId'] = 'Bus'.Bus::$count;
      $this->bs->fillAction($params);
    }

    public function showMtns(){
      // here feeds $mtns to page @uda.
    }

    #function added by @devin for updating distance if wrong please rectify
    public function updatedistance($params){
      $this->bs->stateChange();
      $this->bs->updateDistance($params);
    }




}
