<?php

class ServiceMatrics extends Model{

    public static $Instance;

    public function __construct($service=''){
        $table='servicematrics';
        parent::__construct($table,'ServiceMatrics','ServiceId');
        if ($service != '') {
            if (substr($service,0,4)=='Serv') {
                $s = $this->_db->findFirst('servicematrics', ['conditions'=>'ServiceId = ?', 'bind'=>[$service]]);
            }
            if ($s) {
                foreach ($s as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function addLabour($LabId){
        if ($this->addColumn($LabId,'INT(11)')){
            return true;
        }
        return false;
    }

    public function addService($params){
        $this->assign($params);
        $this->save();
    }
}