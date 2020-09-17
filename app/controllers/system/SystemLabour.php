<?php


class SystemLabour extends System
{
    private  $systemlab = NULL;
    private  $LabourActiveModel;
    private  $UsersModel;

    public function __construct(){
        $this->LabourActiveModel = ModelCommon::loading_model('LabourActive');
        $this->UsersModel = ModelCommon::loading_model('Users');
    }


    public function get($state='everything'){
        //return all labours on  @devin
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return $this->LabourActiveModel->selectAll('LabourState',$state);
        }elseif ($state == 'everything'){
            return $this->LabourActiveModel->selectAllWithDelete('deleted',0);
        }
        return false;
    }

    public function updateState($id,$state){
        #assuming nic this could lead to error check whether labourId or nic
        $unique=['nic'=>$id];
        $params = ['LabourState'=>$state];
        return $this->LabourActiveModel->UpdateRow($unique,$params);
    }

    public function check($id){
        // TODO: Implement check() method.
    }

    /**
     * @return mixed
     */
    public function getLabour($id)
    {
        return $this->LabourActiveModel->findByLabourId($id);
    }
}