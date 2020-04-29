<?php

class Bus extends Controller{

    private $bs, $_if = false;
    //and some other attributes of bus .e.g. egine_numer, color....


    public function __construct(){
      $this->load_model('bus'); // 'bus' is not sure .
      $bs = new NewBus();

    }

    public function stateChange(){
      $bs.stateChange($this);
    }

    public function setState($st){
      $bs = $st;
    }

    public function show(){
      //this will feed the bus data table accoring to it's bus_id.

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
}
