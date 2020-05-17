<?php

class Service extends Controller{

  //Attrs of service
  private $ss, $_if = false, $time_bool = false;
  private static $count = 0;
  private $ServiceId;

  public function __construct($params,$condition=false){
      if($condition){
          $this->set_trigger();
      }
      $this->ServiceId = Service::$count;
      $this->ss = new NewService($this,$params,$this->ServiceId);
      Service::$count++;
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

  public static function validation($params){
      #validation for outside only returns validation object
      $validation = new Validate();
      $validation->check($params,[
          'BusNumber' => [
              'display' => 'BusNumber',
              'require' => true,
              'unique' => 'bustable',
              'min' => 8  #check
          ],
          'ServiceType' => [
              'display' => 'Service Type',
              'require' => true,
          ],
          'Labourers' => [
              'display' => 'Labourers',
              'require' => true,
              'min' => 4,
          ],
          'ServiceInitiatedDate' => [
              'display' => 'Start Date',
              'require' => true
          ]
      ]);
      return($validation);
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
