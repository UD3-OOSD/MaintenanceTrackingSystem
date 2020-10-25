<?php

abstract class Communication{
    abstract function resetSelf();
    abstract function setDetails($params);
    abstract function execute();
    abstract function communicate($model);
    abstract function return();
}