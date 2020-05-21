<?php

require_once(ROOT.DS.'app/controllers/bus/NewBus.php');


class Bus extends Controller{

    //
    private $mtns ;
    private $bs, $_if = false;
    //and some other attributes of bus .e.g. egine_numer, color....


    public function __construct(){

<<<<<<< HEAD

        #$this->load_model('BusM'); // 'bus' is not sure .its' Maintainance details as well @avishka.
        $bs = new NewBus();
=======
      #$this->load_model('BusM'); // 'bus' is not sure .its' Maintainance details as well @avishka.
      $this->bs = new NewBus();

>>>>>>> ad28b5d2ddba512b4c48cbcba277083e4438b20b

    }

    public function stateChange(){
      $this->bs->stateChange($this);
    }

    public function setState($st){
      $bs = $st;
    }

    public function getState(){
      return $this->bs;
    }

    public function get_trigger(){
      return $this->_if;
    }

    public function set_trigger($val){
      $_if = $val;
    }

    public function showData(){
      //this will feed the bus data table accoring to it's bus_id. @uda

    }
    public function fillAction($params){
        $this->bs->fillAction($params);
    }

    public function showMtns(){
      // here feeds $mtns to page @uda.
    }

    #function added by @devin for updating distance if wrong please rectify
    public function updatedistance($params){
      $this->stateChange();
      $this->bs->updateDistance($params);
    }




}
