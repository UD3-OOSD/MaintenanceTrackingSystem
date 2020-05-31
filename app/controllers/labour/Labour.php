<?php

require_once(ROOT.DS.'app/controllers/labour/NewDeactiveLabour.php');

class Labour{

  //here labour attributes
  #private static $count;
  private static $labours = [];
  private static $keys = ['Admin','Forman'];
  private static $caller = '';

  private $ls, $_if = false;

  private static $lab = NULL;

  private function __construct(){
    $this->ls = NewDeactiveLabour::getInstance();
    #self::$count++;
  }

  public static function getMultitance($key){
      #dnd($key);
    if(!in_array($key,Labour::$keys)){
      return null;
    }else{
      if(!in_array($key,Labour::$labours)){
          Labour::$labours[$key] = new Labour();
      }
      Labour::$caller = $key;
      return Labour::$labours[$key];
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

  public function fillAction($params){
    #$data['LabourId'] = 'Lab'.Labour::$count;
    $this->ls->fill($params);
  }

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return $this->_if;
  }

}
