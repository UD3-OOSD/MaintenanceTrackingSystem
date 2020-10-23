<?php

abstract class Communication{
    abstract function resetSelf();
    abstract function setDetails($params);
    abstract function execute();
}