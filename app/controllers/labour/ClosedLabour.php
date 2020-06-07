<?php

class ClosedLabour implements LabourState{

  private static $closelab = NULL;
  private static $LabourActiveModel;

  private function __construct(){
      ClosedLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
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

  public function delete($id){
    //delete particular records @avishka
    // add softdelete function in here. @devin.
    ClosedLabour::$LabourActiveModel->deleted($id,'nic');

  }

    public function fill($data)
    {
        // TODO: Implement fill() method.
    }
}
