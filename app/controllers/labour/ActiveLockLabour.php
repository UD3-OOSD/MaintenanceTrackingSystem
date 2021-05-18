<?php

class ActiveLockLabour  implements LabourState{

  private static $actlocklab = NULL;
  private static $LabourActiveModel;

  private function __construct(){
      ActiveLockLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
  }

  public static function getInstance(){
    if(!isset(ActiveLockLabour::$actlocklab)){
      ActiveLockLabour::$actlocklab = new ActiveLockLabour();
    }
    return ActiveLockLabour::$actlocklab;
  }

  public function stateChange($lab){
    if($lab->get_trigger()){
      $lab->setState('4');
    }else{
      $lab->setState('3');
    }
  }

  public function fitAction($lab_id){
    $lab_details = $this->Labour->findByUserName($lab_id);

  }

  public function checkId($id){
     // dnd(ActiveLockLabour::$LabourActiveModel);
    return ActiveLockLabour::$LabourActiveModel->isLabourNICValid($id);
  }

    public function fill($data)
    {
        // TODO: Implement fill() method.
    }
}
