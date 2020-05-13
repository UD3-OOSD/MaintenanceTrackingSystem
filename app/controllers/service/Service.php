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
    $this->view->heading = "service details";
    $this->view->details = ['name'=>'oil change','service id'=> 'S09231','date'=>'21/06/2020','bus id'=>'B452','run distace'=>'2341Km','states'=>'accepted'];
    $this->view->render('home/service');
    return $data;
  }
}
