<?php


interface LabourState
{

  public function stateChange($lab);
  public function fill($data);
}
