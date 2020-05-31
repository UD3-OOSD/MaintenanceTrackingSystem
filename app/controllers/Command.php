<?php

abstract class Command extends Conntroller{

  public function __construct($contrller,$action){
    parent::__construct($contrller, $action);
  }

  abstract function getMultitance($key);
  abstract function stateChange();
  abstract function setState($st);
  abstract function getState();
  abstract function get_trigger();
  abstract function set_trigger();
  abstract function reset_trigger();
  abstract function showData();
  abstract function fillAction($params);
  abstract function setAttr($params);

}
