<?php

class Service{

  //Attrs of service
  private $services = [];
  private $caller = '';
  private $keys = ['admin','mechanics','forman'];

  private $ss, $_if = false, $time_bool = false;
  #private static $count = 0;
  private $ServiceId;

  private static $service = NULL;

  private function __construct(){
    #$this->ServiceId = Service::$count;
    $this->ss = NewService::getInstance();
    #Service::$count++;
  }

  public static function getMultitance($key){
    if(!isset($keys[$key])){
      return null;
    }else{
      if(!isset($services[$key])){
        $services[$key] = new Service();
      }
      $caller = $key;
      return $services[key];
    }
  }

  public function stateChange(){
    $this->ss->stateChange($this);
  }

  public function setState($st){
      $this->ss = $st;
  }
  public function setAttr($data){
      $columns = ModelCommon::getColumnNames('activeservices');
      foreach ($data as $key => $value){
          if(in_array($key,$columns)){
              $this->$key = $value;
          }
      }
  }
  public function fillAction($params,$actor){
      $this->ss->fillAction($params,$this);
      $this->setAttr($params);
  }

  public function get_trigger(){
    return $this->_if;
  }

  public function set_trigger(){
      $this->_if= true;
  }

  public function reset_trigger(){
      $this->_if= false;
  }

  public function getState(){
    return $this->ss->getState();
  }

  public function get_time_trigger(){
    return $this->time_bool;
  }

  public function show_detail(){
    // gather all features to $data.   @devin
    return $this->data;
  }

  public function show(){
    //gather some details to $data. @stats_absolute_deviation
    return $this->data;
  }


  public function edit($ServiceId){
      $this->ss->edit($ServiceId);
  }
}
