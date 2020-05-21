<?php

require_once(ROOT.DS.'app/controllers/labour/NewDeactiveLabour.php');

class Labour extends Controller{

  //here labour attributes
  private static $count;
  private $ls, $_if = false;

  private static $labour = NULL;

  private function __construct(){
    $ls = NewDeactiveLabour::getInstance();
    Labour::$count++;
  }

  public static function getInstance(){
    if(!isset(Labour::$lab)){
      Labour::$lab = new Labour();
    }
    return Labour::$lab;
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
    $data['LabourId'] = 'Lab'.Labour::$count;
    $this->ls->fill($data);
  }

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return $this->_if;
  }

}
