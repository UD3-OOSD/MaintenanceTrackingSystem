<?php

class Service extends Controller{

  //Attrs of service
  private $ss, $_if = false, $time_bool = false;

  public function __construct($params){
      $this->ss = new NewService($this,$params);
  }

  public function stateChange(){
    $this->ss->stateChange($this);
  }

  public function setState($st){
      $this->ss = $st;
  }

  public function setAttrs($data){
    //ser values to attrs
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
          'ServiceStartDate' => [
              'display' => 'Start Date',
              'require' => true
          ]
      ]);
  }


  public function get_trigger(){
    return $this->_if;
  }

  public function getState(){
    return $this->ss;
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
}
