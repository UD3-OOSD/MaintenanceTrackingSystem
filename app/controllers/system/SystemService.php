<?php


class SystemService implements System
{
    private static $systemservice = NULL;
    private $ServiceActiveModel;

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
        //get all services on given $state  @devin
    }

    public function updateState($id,$state)
    {
        //save $state in $id @devin
    }

    public function check($id)
    {
        // get date of given $id @devin.
        // check is service expired @nipun.
    }
}