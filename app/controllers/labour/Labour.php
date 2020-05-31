<?php

require_once(ROOT.DS.'app/controllers/labour/NewDeactiveLabour.php');

class Labour{

  //here labour attributes
  #private static $count;
  private $labours = [];
  private $keys = ['admin','forman'];

  private $ls, $_if = false;

  private static $lab = NULL;

  private function __construct(){
    $this->ls = NewDeactiveLabour::getInstance();
    #self::$count++;
  }

  public static function getMultitance($key){
    if(!isset($keys[$key])){
      return null;
    }else{
      if(!isset($labours[$key])){
        $labours[$key] = new Labour();
      }
      return $labours[key];
    }
  }

  public function stateChange(){
    $this->ls->stateChange($this);
  }

  public function setState($st){
    $this->ls = st;
  }

  public function getState(){
    return $this->ls;
  }

  public function fillAction($data){
    #$data['LabourId'] = 'Lab'.Labour::$count;
    $this->ls->fill($data);
  }

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return $this->_if;
  }

}
