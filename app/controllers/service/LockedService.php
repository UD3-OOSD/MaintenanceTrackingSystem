<?php


class LockedService implements ServiceState{

    private static $lockedservice;
    private static $ServiceActiveModel;

    private function __construct(){
        LockedService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
    }

    public static function getInstance(){
        if(!isset(LockedService::$lockedservice)){
            LockedService::$lockedservice = new LockedService();
        }
        return LockedService::$lockedservice;
    }

    public function stateChange($service){
        $service->setState('0');
        LockedService::$ServiceActiveModel->stateChange($service->getId(),8);
    }
/*
    public function stateChange($service,$state){
        $service->setState($state);
    }*/

    public function checkId($id){
        //@devin.
        return LockedService::$ServiceActiveModel->isServiceIdValid($id);
    }

    public function saveState($id,$state){
        //@devin
        return LockedService::$ServiceActiveModel->stateChange($id,$state);
    }

    public function fetchState($id){
        return LockedService::$ServiceActiveModel->getState($id);
    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}