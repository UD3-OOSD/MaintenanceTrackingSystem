<?php


class SystemService implements System
{
    private static $systemservice = NULL;
    private static $ServiceActiveModel;

    private function __construct(){
        $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
    }

    public static function getInstance(){
        if(!isset(SystemService::$systemservice)){
            SystemService::$systemservice = new SystemService();
        }
        return SystemService::$systemservice;
    }

    public function get($state='')
    {
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return SystemService::$ServiceActiveModel->selectAll('ServiceState',$state);
        }
        return false;
    }

    public function updateState($id,$state)
    {
        $unique=['ServiceId'=>$id];
        $params = ['ServiceState'=>$state];
        return SystemService::$ServiceActiveModel->UpdateRow($unique,$params);
        //save $state in $id @devin
    }

    public function check($id)
    {

        // get date of given $id @devin.
        // check is service expired @nipun.
    }
}