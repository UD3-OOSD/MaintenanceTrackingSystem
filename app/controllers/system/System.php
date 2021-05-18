<?php

abstract class System{
    protected $_systemName;

    public function __construct($name)
    {
        $this->_systemName = $name;
    }

    public abstract function get($state='');
    public abstract function updateState($id,$state);
    public abstract function check($id);
}
