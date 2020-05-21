<?php

require_once(ROOT.DS.'app/controllers/labour/NewDeactiveLabour.php');

class Labour extends Controller{

  //here labour attributes
  private static $count = 0;
  private $ls, $_if = false;


  public function __construct(){
    $ls = new NewDeactiveLabour();
    Labour::$count++;
  }

  public function stateChange(){
    $ls->stateChange($this);
  }

  public function setState($st){
    $ls = st;
  }

  public function getState(){
    return $ls;
  }

  public function fillAction($data){
    $data['LabourId'] = 'Lab'.Labour::$count;
    $this->ls->fill($data);
  }

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return $_if;
  }

}
