<?php

class NewActiveLabour extends Controller implements LabourState{

  public function stateChange($lab){
    $lab->setState(new ActiveLockLabour());
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
