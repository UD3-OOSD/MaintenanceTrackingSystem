<?php

class ActiveLabour extends Controller implements LabourState{

  public function stateChange($lab){
    $lab->setState(new ActiveLockLabour);
  }

  public function edit($lab,$data){    // only has access to the Admin. @devin
    $lab->setAttr($data);
    $this->stateChange($lab);
  }
}
