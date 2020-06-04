<?php

class ActiveLabour implements LabourState{

  private static $actlab = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ActiveLabour::$actlab)){
      ActiveLabour::$actlab = new ActiveLabour();
    }
    return ActiveLabour::$actlab;
  }

  public function stateChange($lab){
    $lab->setState(ActiveLockLabour::getInstance());
  }

  public function edit($lab,$data){    // only has access to the Admin. @devin
    $lab->setAttr($data);
    $this->stateChange($lab);
  }

    public function fill($data)
    {
        // TODO: Implement fill() method.
    }

    public function updateDetails($params){
      //@devin.
    }

}
