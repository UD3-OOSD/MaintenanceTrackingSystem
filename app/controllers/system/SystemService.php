<?php


class SystemService extends System
{
    private  $systemservice = NULL;
    private  $ServiceActiveModel;

    public function __construct(){
        $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
    }



    public function get($state='')
    {
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return $this->ServiceActiveModel->selectAll('ServiceState',$state);
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
        // check is service expired @nipun.
    }


}