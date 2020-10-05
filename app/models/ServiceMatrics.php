<?php

class ServiceMatrics extends Model{

    public static $Instance;
    public static $states;
    private static $table;

    public function __construct($service=''){
        $this->idtype = 'ServiceId';
        ServiceMatrics::$table='servicematrics';
        ServiceMatrics::$states = [0 => 'NewService',
                                  1 => 'InitService',
                                  2 => 'LockedService',
                                  3 => 'ApprovedService',
                                  4 => 'StartedService',
                                  5 => 'FinishedService',
                                  6 => 'ClosedService',
                                  7 => 'ExpiredService',
                                  8 => 'DeletedService' ];

        parent::__construct(ServiceMatrics::$table,'ServiceMatrics');
        if ($service != '') {
            if (substr($service,0,4)=='Serv') {
                $s = $this->_db->findFirst('servicematrics', ['conditions'=>'ServiceId = ?', 'bind'=>[$service]]);
            }
            if (isset($s)) {
                foreach ($s as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public static function addLabour($LabId){
        if (ModelCommon::addColumn(ServiceMatrics::$table,$LabId,'INT(11)',-1)){
            return true;
        }
        return false;
    }

    public function addService($params){
        $this->assign($this->reformingParameters($params));
        $this->save();
    }

    public function reformingParameters($params){
        $reformed=[];
        $columns = ($this->_columnNames);
        #dnd($columns);
        $reformed['ServiceId'] = $params['ServiceId'];
        $reformed['deleted'] = 0;

        #dnd($reformed);
        if($params['Labourers']){
            foreach (explode(',',trim($params['Labourers'])) as $Labourer){
                $reformed[$Labourer] = $params['ServiceState'];
            }

            foreach($this->_columnNames as $column){
                if(!isset($reformed[$column])){
                    $reformed[$column] = -1;
                }
            }
        }
        #dnd($reformed);
        return $reformed;
    }

    public function deleteService($ServiceId){
        return $this->delete($ServiceId,$this->idtype);
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
                return $this->selectAllArray('ServiceId', $ServiceId);
            }
        }
    }

    public function forSelectedLabouror($Labour){
        $services =[];
        if (isset($Labour)) {
            foreach (ServiceMatrics::$states as $state => $state_name) {
                $state_service = ($this->selectAllArray(Nic2LabId($Labour), $state));
                if (isset($state_service['ServiceId'])) {
                    $state_service = [$state_service];
                }
                $services = array_merge($state_service, $services);
            }
        }
        #dnd($services);
        return($services);
    }

    public function getServicesforLabour($LabourId){
        $services = $this->forSelectedLabouror($LabourId);
        //dnd($services);
        $serviceIds = [];

        foreach($services as $service){
            $serviceIds[$service['ServiceId']]=$service[Nic2LabId($LabourId)];
        }
        #dnd($serviceIds);
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