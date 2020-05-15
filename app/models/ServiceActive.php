<?php

class ServiceActive extends Model{
    public function __construct($service=''){
        $table='activeservices';
        parent::__construct($table);
        if ($service != '') {
            if (is_int($service)) {
                $s = $this->_db->findFirst('activeservices', ['conditions'=>'ServiceId = ?', 'bind'=>[$service]]);
            }
            if ($s) {
                foreach ($s as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }



    public function allServicesForBus($BusNumber){
        return $this->find(['conditions'=>'BusNumber = ?', 'bind'=>[$BusNumber]]);
    }

    public function allServicesByState($state){
        return $this->find(['conditions'=>'ServiceState = ?', 'bind'=>[$state]]);
    }

    public function specificService($BusNumber,$ServiceType){
        return $this->findFirst(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$ServiceType]]);
    }


    public function registerNewService($params){
        $this->assign($params);
        $this->save();

    }
}