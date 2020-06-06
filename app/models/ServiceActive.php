<?php

class ServiceActive extends Model{
    public function __construct($service=''){
        $table='activeservices';
        parent::__construct($table,'ServiceActive','ServiceId');
        if ($service != '') {
            if (substr($service,0,4)=='Serv') {
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
        $this->deleted = 0;
        $this->ServiceId = 'Serv' . ModelCommon::nextID($this->_table);
        $this->ServiceState =0;
        $this->save($this->idtype);

    }
    public function stateChange_this($state){
        return $this->stateChange($this->ServiceId,$state);
    }

    public function stateChange($id,$state){
        if(isset($id)&&isset($state)){
            $unique=['ServiceId'=>$id];
            return $this->UpdateRow($unique,['ServiceState'=>$state]);
        }
        return(false);
    }

    public function  isServiceIdValid($id){
        $params=['ServiceId'=>$id];
        return $this->isValidKey($params);
    }

    public function edit($id,$params){
        return $this->UpdateRow(['ServiceId'=>$id],$params);
    }
    public function edit_this($params){
        return $this->edit(['ServiceId'=>$this->ServiceId],$params);
    }
    public function delete(){
        $this->delete(['ServiceId'=>$this->ServiceId]);
    }

}