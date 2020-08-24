<?php

class Service{

  //Attrs of service
  private static $services = [];
  private static $caller = '';
  private static $keys = ['Admin','Mechanics','Forman'];

  private static $ss, $_if = true, $time_bool = true, $service_id = '';
  #private static $count = 0;
  #private $ServiceId;

  private static $service = NULL;


  public static function getMultitance($key,$state){
    if(!in_array($key,Service::$keys)){
      return null;
    }else{
      if(!in_array($key,Service::$services)){
        Service::$services[$key] = new Service();
      }
      Service::$caller = $key;
      Service::setState($state);
      return Service::$services[$key];
    }
  }

  public function stateChange(){
    Service::$ss->stateChange($this);
  }

  public static function setId($id){
      Service::$service_id = $id;
  }

  public static function getId(){
      return Service::$service_id;
  }

  public static function setState($st){
      switch ($st){
          case '0':
              Service::$ss = NewService::getInstance();
              break;
          case '1':
              Service::$ss = InitService::getInstance();
              break;
          case '2':
              Service::$ss = LockedService::getInstance();
              break;
          case '3':
              Service::$ss = ApprovedService::getInstance();
              break;
          case '4':
              Service::$ss = StartedService::getInstance();
              break;
          case '5':
              Service::$ss = FinishedService::getInstance();
              break;
          case '6':
              Service::$ss = ClosedService::getInstance();
              break;
          case '7':
              Service::$ss = ExpiredService::getInstance();
              break;
          case '8':
              Service::$ss = DeletedService::getInstance();
              break;
      }
      #return Service::$ss;
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
      Service::$ss->fillAction($params,$this);
      $this->setAttr($params);
  }

  public function get_trigger(){
    return Service::$_if;
  }

  public function set_trigger($int){
      if($int == 1){
          Service::$_if= true;
      }elseif( $int == 0) {
          Service::$_if = false;
      }
  }

  public function reset_trigger(){
      Service::$_if= true;
  }

  public function getState(){
    return Service::$ss;
  }

  public function get_time_trigger(){
    return Service::$time_bool;
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
      Service::$ss->edit($ServiceId);
  }
}
