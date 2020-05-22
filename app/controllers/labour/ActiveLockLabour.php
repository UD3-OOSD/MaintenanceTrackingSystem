<?php

class ActiveLockLabour  implements LabourState{

  private static $actlocklab = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ActiveLockLabour::$actlocklab)){
      ActiveLockLabour::$actlocklab = new ActiveLockLabour();
    }
    return ActiveLockLabour::$actlocklab;
  }

  public function stateChange($lab){
    if($lab->get_trigger()){
      $lab->setState(ClosedLabour::getInstance());
    }else{
      $lab->setState(ActiveLabour::getInstance());
    }
  }

    public function fill($data)
    {
        // TODO: Implement fill() method.
    }
}
