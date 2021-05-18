<?php

abstract class Command extends Controller{

  public function __construct($contrller,$action){
    parent::__construct($contrller, $action);
  }

  abstract static function getMultitance($key,$state);
  abstract function stateChange();
  abstract function getState();
  abstract function get_trigger();
  abstract function set_trigger();
  abstract function reset_trigger();
  abstract function showData($id);
  abstract function fillAction($params);
  abstract function setAttr($params);

}
