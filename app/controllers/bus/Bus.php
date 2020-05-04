<?php

class Bus extends Controller{

    //
    private $mtns ;
    private $bs, $_if = false;
    //and some other attributes of bus .e.g. egine_numer, color....


    public function __construct(){
      $this->load_model('BM'); // 'bus' is not sure .its' Maintainance details as well @avishka.
      $bs = new NewBus();

    }

    public function stateChange(){
      $bs.stateChange($this);
    }

    public function setState($st){
      $bs = $st;
    }

    public function getState(){
      return $bs;
    }

    public function get_trigger(){
      return $_if;
    }

    public function set_trigger($val){
      $_if = $val;
    }

    public function showData(){
      //this will feed the bus data table accoring to it's bus_id. @uda

    }

    public function showMtns(){
      // here feeds $mtns to page @uda.
    }

    #function added by @devin for updating distance if wrong please rectify
    public function updatedistance(){
      $this->stateChange($this);
      $this->bs->updateDistance();
    }




}
