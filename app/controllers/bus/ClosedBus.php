<?php

class ClosedBus extends Controller implements BusState{

  public function stateChange($bus){
    //no idea about state change @devin
    $this->delete();  // like
  }

  public function delete(){ // or can call directly to Model @avishka.
    //delete from $bussess.
  }
}
