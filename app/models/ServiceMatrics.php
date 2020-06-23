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

    public function getLabourersforService($ServiceId){
        $service = $this->forselectedService($ServiceId);
        $labourers=[];

        foreach ($service as $key=>$value){
            if($value == 1){
                $labourers[]=$key;
            }
        }

        return $labourers;
    }
    public function forselectedService($ServiceId){
        if(isset($ServiceId)){
            return $this->selectAllArrayWithDelete('ServiceId',$ServiceId);
        }
    }

    public function forSelectedLabouror($Labour){
        if (isset($Labour)){
            return $this->selectAllArrayWithDelete(Nic2LabId($Labour),1);
        }
    }

    public function getServicesforLabour($LabourId){
        $services = $this->forSelectedLabouror($LabourId);
        $serviceIds = [];

        if(isset($services['ServiceId'])){
            $services = [$services];
        }

        foreach($services as $service){
            $serviceIds[]=$service['ServiceId'];
        }

        return $serviceIds;
    }

    public function checkLabourInvolved(){
        $labours=[];
        foreach ($this->_columnNames as $name){
            if ($this->{$name} == 1){
                $labours[]=$name;
            }
        }
        return $labours;
    }

    public function LabourorsInService($Labourors){
        #['ServiceId' => ['Lab12','Lab13']]
        $params =[];
        foreach ($Labourors as $ServiceId => $labourIds){
            foreach ($labourIds as $LabourId){
                $params[$LabourId]=1;
            }

            $params['ServiceId'] = $ServiceId;
        }

        $this->addService($params);
    }
}