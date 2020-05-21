<?php

class NewActiveLabour extends Controller implements LabourState{

  private static $newaclab = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(NewActiveLabour::$newaclab)){
      NewActiveLabour::$newaclab = new NewActiveLabour();
    }
    return NewActiveLabour::$newaclab;
  }

  public function stateChange($lab){
    $lab->setState(ActiveLockLabour::getInstance());
  }

  public function edit(){ //like a regiter.php
    //call to validation class.
    // do the logic @devin
    // sample
    //if($valid){
    //  $this->view->render('regiter/login'); // call to home.
    //  $this->stateChange($lab);
    //  return;
    //}

    $this->view->render('edit'); //@uda
  }


}
