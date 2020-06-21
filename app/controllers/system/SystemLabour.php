<?php


class SystemLabour implements System
{
    private static $systemlab = NULL;
    private static $LabourActiveModel;
    private static $UsersModel;

    private function __construct(){
        SystemLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
        SystemLabour::$UsersModel = ModelCommon::loading_model('Users');
    }

    public static function getInstance(){
        if(!isset(SystemLabour::$systemlab)){
            SystemLabour::$systemlab = new SystemLabour();
        }
        return SystemLabour::$systemlab;
    }

    public function get($state=''){
        //return all labours on  @devin
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return SystemLabour::$LabourActiveModel->selectAll('LabourState',$state);
        }
        return false;
    }

    public function updateState($id,$state){
        #assuming nic this could lead to error check whether labourId or nic
           
    }

    public function check($id){
        // TODO: Implement check() method.
    }
}