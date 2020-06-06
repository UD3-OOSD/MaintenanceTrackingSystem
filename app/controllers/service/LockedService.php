<?php


class LockedService implements ServiceState{

    private static $lockedservice;

    private function __construct(){

    }

    public static function getInstance(){
        if(!isset(LockedService::$lockedservice)){
            LockedService::$lockedservice = new LockedService();
        }
        return LockedService::$lockedservice;
    }

    public function stateChange($service){
        $service->setState('0');
    }
/*
    public function stateChange($service,$state){
        $service->setState($state);
    }*/

    public function checkId($id){
        //@devin.
    }

    public function saveState($id){
        //@devin
    }

    public function fetchState($id){

    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }

    public function fillAction($params, $obj)
    {
        // TODO: Implement fillAction() method.
    }
}