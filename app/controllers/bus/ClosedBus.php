<?php

class ClosedBus extends Controller implements BusState{
  #what is closed bus state scraping of the bus?
  public function stateChange($bus){
    //no idea about state change @devin
    $this->delete();  // like
  }

  public function delete(){ // or can call directly to Model @avishka.
    //delete from $bussess with related services but not all. @avishka
  }
}
