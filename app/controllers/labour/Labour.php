<?php

require_once(ROOT.DS.'app/controllers/labour/NewDeactiveLabour.php');

class Labour extends Controller{

  //here labour attributes
  private $ls, $_if = false;

  public function __construct(){
    $ls = new NewDeactiveLabour();
    $ls->fill($data);
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

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return $_if;
  }

}
