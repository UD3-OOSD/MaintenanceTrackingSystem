<?php

class ClosedLabour extends Controller implements LabourState{

  public function stateChange($lab){
    $this->delete($lab);

  }

  public function delete($lab){
    //delete particular records @avishka
  }
}
