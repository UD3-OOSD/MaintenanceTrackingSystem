<?php

class ServiceMatrics extends Model{

    public static $Instance;
    public static $states;

    public function __construct($service=''){
        $table='servicematrics';
        ServiceMatrics::$states = [0 => 'NewService',
                                  1 => 'InitService',
                                  2 => 'ApprovedService',
                                  3 => 'StartedService',
                                  4 => '',
                                  5 => '',
                                  6 => '',
                                  7 => '',
                                  8 => '' ];

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
            if($value != null){
                $labourers[$key]=$value;
            }
        }

        return $labourers;
    }
    public function forselectedService($ServiceId){
        if(isset($ServiceId)){
            if($this->isValidKey(['ServiceId'=>$ServiceId])) {
                return $this->selectAllArray('ServiceId', $ServiceId, false);
            }
        }
    }

    public function forSelectedLabouror($Labour){
        $services =[];
        if (isset($Labour)){
            foreach(ServiceMatrics::$states as $state => $state_name){
                $services = $services + $this->selectAllArray(Nic2LabId($Labour),$state, false);
            }
        }

        return($services);
    }

    public function getServicesforLabour($LabourId){
        $services = $this->forSelectedLabouror($LabourId);
        dnd($services);
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
            if ($this->{$name} != 1){
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