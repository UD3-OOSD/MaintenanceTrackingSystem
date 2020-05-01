<?php

class Service extends Controller{

  //Attrs of service
  private $ss, $_if = false, $time_bool = false;

  public function __construct(){
    $ss = new NewService($this,$data);
  }

  public function stateChange(){
    $ss->stateChange($this);
  }

  public function setState($st){
    $ss = $st;
  }

  public function setAttrs($data){
    //ser values to attrs
  }

  public function get_trigger(){
    return $_if;
  }

  public function getState(){
    return $ss;
  }

  public function get_time_trigger(){
    return $time_bool;
  }

  public function show_detail(){
    // gather all features to $data.   @devin
    return $data;
  }

  public function show(){
    //gather some details to $data. @stats_absolute_deviation
    return $data;
  }
}
