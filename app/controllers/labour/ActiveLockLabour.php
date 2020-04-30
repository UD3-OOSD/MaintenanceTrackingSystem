<?php

class ActiveLockLabour extends Controller implements LabourState{

  public function stateChange($lab){
    if($lab->get_trigger()){
      $lab->setState(new ClosedLabour());
    }else{
      $lab->setState(new ActiveLabour());
    }
  }
}
