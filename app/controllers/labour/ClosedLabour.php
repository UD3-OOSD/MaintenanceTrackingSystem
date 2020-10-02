<?php

class ClosedLabour implements LabourState{

  private static $closelab = NULL;
  private static $LabourActiveModel;
  private static $UsersModel;

  private function __construct(){
      ClosedLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
      ClosedLabour::$UsersModel = ModelCommon::loading_model('Users');
  }

  public static function getInstance(){
    if(!isset(ClosedLabour::$closelab)){
      ClosedLabour::$closelab = new ClosedLabour();
    }
    return ClosedLabour::$closelab;
  }

  public function stateChange($lab){
    $this->delete($lab);

  }

  public function delete($nic){
    //delete particular records @avishka
    // add softdelete function in here. @devin.
    #dnd(currentUser());
    $LabourId = Nic2LabId($nic);
    if(currentUser()->LabourId != $LabourId){
        ClosedLabour::$UsersModel->delete($LabourId,'LabourId');
        ClosedLabour::$LabourActiveModel->delete($nic,'nic');
    }

  }

    public function fill($data)
    {
        // TODO: Implement fill() method.
    }
}
