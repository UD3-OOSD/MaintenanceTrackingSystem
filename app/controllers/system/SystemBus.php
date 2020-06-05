<?php


class SystemBus implements System
{
    private static $bystembus = NULL;
    private static $BusMSModel;
    private static $BusMEModel;

    private function __construct(){
        SystemBus::$BusMSModel = ModelCommon::loading_model('BusMS');
        SystemBus::$BusMEModel = ModelCommon::loading_model('BusME');
    }

    public static function getInstance(){
        if(!isset(SystemBus::$bystembus)){
            SystemBus::$bystembus = new SystemBus();
        }
        return SystemBus::$bystembus;
    }
    public function get($state = '')
    {
        // return all busses on given  @devin
    }

    public function updateState($id,$state)
    {
        // TODO: Implement updateState() method.
    }

    public function check($id)
    {
        // check are there any service available
    }
}