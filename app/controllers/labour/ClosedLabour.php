<?php

class ClosedLabour extends Controller implements LabourState{

  private static $closelab = NULL;

  private function __construct(){

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

  public function delete($lab){
    //delete particular records @avishka
  }
}
