<?php


class SystemService extends System
{
    private  $systemservice = NULL;
    private  $ServiceActiveModel;
    private  $ServiceMatricsModel;

    public function __construct(){
        $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
        $this->ServiceMatricsModel = ModelCommon::loading_model('ServiceMatrics');
    }



    public function get($state='')
    {
        if (is_int($state)){

            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return $this->ServiceActiveModel->selectAll('ServiceState',$state);
        }
        return false;
    }

    public function getWithId($id,$state=''){
        if (is_int($state)){

            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return $this->ServiceMatricsModel->selectAll('ServiceState',$state);
        }
        return false;
    }

    public function updateState($id,$state)
    {
        $unique=['ServiceId'=>$id];
        $params = ['ServiceState'=>$state];
        return $this->ServiceActiveModel->UpdateRow($unique,$params);
        //save $state in $id @devin
    }

    public function check($id){
        // get date of given $id @devin.
        //Service::setId($id);
        $state = $this->ServiceActiveModel->getState($id);
        #dnd($state);
        // check is service expired @nipun.
        if($state != ''){
            #dnd($state);
            Service::setState(strval($state));
            return 'Okay';
        }
        else{
            echo("there is no such a ServiceId");
            return  null;
        }
    }

    public function checkSpecificLab($lab,$state){
        //dnd($lab);
        $services = ($this->ServiceMatricsModel->getServicesforLabour($lab));
        $result = [];
        foreach ($services as $service=> $service_state){
            if ($service_state==$state){
                $result[]=$this->ServiceActiveModel->selectAll('ServiceId',$service);
            }
        }
        #dnd("here");

        $filtered = [];
        //foreach($result as $r){
         //   if($r )
        //}
        //$finished=[];
        if(is_array($result)){
            //$finished = [];
            foreach ($result as $r){
                $arr = (array)$r;
                if ($arr){
                    $filtered[] = $r;
                }
            }
        }
        #dnd($filtered);
        return($filtered);
    }

    public function checkService(){
        $this->ServiceActiveModel->checkAll();
    }

    public function updateServicesMetrics($id){
        $params = ObjecttoArray($this->ServiceActiveModel->findByServiceId($id));
        $this->ServiceMatricsModel->addService($params);
    }


}