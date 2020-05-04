<?php

interface BusState{
  // here we call and link to the busModel. ?if is it possible.
  $this->load_model('BM');
  public function stateChange($bus);
}
