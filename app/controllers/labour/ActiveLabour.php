<?php

class ActiveLabour implements LabourState{

  private static $actlab = NULL;
  private static $LabourActiveModel;

  private function __construct(){
    ActiveLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
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
      $labour = ActiveLabour::$LabourActiveModel->findByNIC($params['nic']);
      $labour->edit_this($params);

      #return (ActiveLabour::$LabourActiveModel->edit($params['nic'],$params));
    }

}
