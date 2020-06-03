<?php

class Labour extends Command {

  //here labour attributes
  #private static $count;
  private static $labours = [];
  private static $keys = ['Admin','Forman'];
  public static $caller = '';

  private static $ls, $_if = false;

  private static $lab = NULL;


  public static function getMultitance($key,$state){
      #dnd($key);
    if(!in_array($key,Labour::$keys)){
      return null;
    }else{
      if(!in_array($key,Labour::$labours)){
          Labour::$labours[$key] = new Labour();
      }
      Labour::$caller = $key;
      Labour::setState($state);
      return Labour::$labours[$key];
    }
  }

  public function stateChange(){
    Labour::$ls->stateChange($this);
  }

  public static function setState($st){
    switch ($st){
        case '0':
            Labour::$ls = NewDeactiveLabour::getInstance();
            break;
        case '1':
            Labour::$ls = NewActiveLabour::getInstance();
            break;
        case '2':
            Labour::$ls = ActiveLockLabour::getInstance();
            break;
        case '3':
            Labour::$ls = ActiveLabour::getInstance();
            break;
        case '4':
            Labour::$ls = ClosedBus::getInstance();
            break;
    }
  }

  public function getState(){
    return Labour::$ls;
  }

  public function fillAction($params){
    #$data['LabourId'] = 'Lab'.Labour::$count;
    Labour::$ls->fill($params);
  }

  public function setAttr($data){
    //here set primary details of labour filled by admin.. @devin
  }

  public function get_trigger(){
    return Labour::$_if;
  }

    function set_trigger()
    {
        Labour::$_if = true;
    }

    function reset_trigger()
    {
        Labour::$_if = false;
    }

    function showData($id)
    {
        // TODO: Implement showData() method.
    }
}
