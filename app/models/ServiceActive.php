<?php

class ServiceActive extends Model{

    public function __construct($service=''){
        $table='activeservices';
        parent::__construct($table,'ServiceActive','ServiceId');
        if ($service != '') {
            $s = null;
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

    public function findByServiceId($id){
        return($this->findFirst(['conditions'=>'ServiceId  = ?','bind'=>[$id]]));
    }




    public function registerNewService($params,$state=0){
        $this->assign($params);
        $this->deleted = 0;
        $this->ServiceId = 'Serv' . ModelCommon::nextID($this->_table);
        $this->ServiceState =$state;
        $this->save();

    }
    public function stateChange_this($state){
        return $this->stateChange($this->ServiceId,$state);
    }

    public function stateChange($id,$state){
        #dnd($id);
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
        return $this->edit($this->ServiceId,$params);
    }

    public function getDate($id){
        $service = $this->selectAll('ServiceId',$id);
        #dnd($service->ServiceDate);
        return($service->ServiceDate);
    }

    public function getState($id){
        $service = $this->selectAll('ServiceId',$id);
        return($service->ServiceState);
    }

    public function checkAll(){
        #$buses = $this->selectAll('deleted',0,$filter=false,$single_lock = false);
        $tables=['bustable','buscategory'];
        $keys = ['BusCategory','BusType'];
        $params = ['bustable.BusId','bustable.BusNumber','buscategory.*','bustable.deleted'];

        $buses  = $this->LeftJoinSpecific($tables,$keys,$params,['deleted'=>0]);

        $tables=['bustable','busmileage'];
        $keys = ['BusNumber','BusNumber'];
        $params = ['bustable.BusId','bustable.BusNumber','busmileage.*'];

        $currentDistances = $this->LeftJoin($tables,$keys,$params);

        #dnd($buses);
        $date = date("Y/m/d");
        #dnd($date);

        foreach ($buses as $bus){
            $BusId = $bus['BusId'];
            $BusNumber = $bus['BusNumber'];
            foreach ($currentDistances as $currentDistance){
                if($currentDistance['BusId'] == $BusId){
                    $relaventDistances = $currentDistance;
                    break;
                }
            }
            foreach($bus as $header=>$value){
                if(!($header=='BusId'|| $header=='BusNumber' || $header== 'BusType' || $header == 'deleted')){
                    if($relaventDistances[$header]>=$value){
                        $this->registerNewService(['ServiceType'=>$header,'ServiceDate'=>$date,'BusNumber'=>$BusNumber,'BusCategory'=>$bus['BusType']],1);
                        ModelCommon::UpdateRow('busmileage',['BusNumber'=>$BusNumber],[$header=>0]);
                    }
                }
            }
        }
    }
}