<?php

class ServiceActive extends Model{

    public function __construct($service=''){
        $table='activeservices';
        parent::__construct($table,'ServiceActive');
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
        #print_r($this);
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

    public function already_exist($BusNumber,$service){
        #echo('<br>');
        #print_r(($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]]))[0]);
        #echo('<br>');
        #dnd($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]]));
        if($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]])){
            #print_r(($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]]))[0]->ServiceId);
            #echo('<br>');
            #echo($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]])[0]->ServiceId);
            #echo('   ');
            #echo($this->find(['conditions'=>['BusNumber = ?','ServiceType = ?'],'bind'=>[$BusNumber,$service]])[0]->ServiceType);
            #echo('<br>');
            return true;
        }
        #echo($service);
        return false;
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
                    #print_r($relaventDistances);
                    #echo('<br>');
                    break;
                }
            }
            #dnd('heyyy');
            #echo($BusNumber);
            #echo('<br>');

            if(isset($relaventDistances)){
                foreach($bus as $header=>$value){
                    if(!($header=='BusId'|| $header=='BusNumber' || $header== 'BusType' || $header == 'deleted')){
                        if(($value)){
                            #echo( $relaventDistances[$header]);
                            #echo('   ');
                            #echo($header);
                            #echo('   ');
                            #echo($value);
                            #echo('   ');
                            #echo('<br>');
                            if(!($relaventDistances[$header]==0) && $relaventDistances[$header]>=$value){
                                #echo($header);
                                #echo('   ');
                                #echo($this->already_exist($BusNumber,substr($header,0,strlen($header)-7)));
                                #echo('<br>');
                                if(!$this->already_exist($BusNumber,substr($header,0,strlen($header)-7))) {
                                    #echo($header);
                                    #echo('limit');
                                    #echo($value);
                                    #echo('current value');
                                    #echo($relaventDistances[$header]);
                                    #echo('<br>');
                                    #echo($this->already_exist($BusNumber,substr($header,0,strlen($header)-7)));
                                    #print_r(['ServiceType'=>substr($header,0,strlen($header)-7),'ServiceDate'=>$date,'BusNumber'=>$BusNumber,'BusCategory'=>$bus['BusType']]);
                                    #echo('<br>');
                                    $this->registerNewService(['ServiceType'=>substr($header,0,strlen($header)-7),'ServiceDate'=>$date,'BusNumber'=>$BusNumber,'BusCategory'=>$bus['BusType']],1);
                                }#ModelCommon::UpdateRow('busmileage',['BusNumber'=>$BusNumber],[$header=>0]);
                            }
                        }
                    }
                }
                #echo('<br>');
            }else{
                return;
            }

        }
        #dnd('welll');
    }
}