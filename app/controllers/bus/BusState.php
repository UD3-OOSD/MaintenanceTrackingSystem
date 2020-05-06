<?php

interface BusState{
  // here we call and link to the busModel. ?if is it possible.
  $this->load_model('BusM');
  public function stateChange($bus);
  public function fitAction($bus,$attr);
  public function updateDistance();
  public function check($data);
  public function addService($data);
  public function delete();
  public function feed();
}
