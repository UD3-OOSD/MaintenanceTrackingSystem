<?php


class BusService extends Model{
    public function __construct($service=''){
        $table='busservices';
        parent::__construct($table,'BusService');
        if ($service != '') {
            if (substr($service,0,4)=='Serv') {
                $s = $this->_db->findFirst($table, ['conditions'=>'ServiceId = ?', 'bind'=>[$service]]);
            }
            if (isset($s)) {
                foreach ($s as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function addService($params){

        $this->assign($this->refine($params));
        $this->save();

    }

    public function refine($params){
        $content = [];
        if (isset($params['ServiceId']) && (isset($params['BusId']) || isset($params['BusNumber']))){
            $content['ServiceId'] = $params['ServiceId'];

            if (isset($params['BusId'])){
                $content['BusId'] = $params['BusId'];
            }
            else{
                $content['BusId'] = BusNumber2Id($params['BusNumber']);
            }

        }
        return ($content);

    }

    public function getBusforService($ServiceId){
        return $this->findFirst(['ServiceId'=>$ServiceId]);//use selectall if necessary
    }

    public function getServicesforBus($BusId){
        $services = $this->selectAllArray('BusId',$BusId);
        return($this->group($services));
    }

    public function group($services){
        $grouped = [];
        if ($services['$serviceId']){
            $grouped = $services;
        }
        else{
            $grouped['BusId'] = $services[0]['BusId'];
            foreach ($services as $service){
                $grouped[] = $service['ServiceId'];
            }
        }

        return($grouped);
    }
}