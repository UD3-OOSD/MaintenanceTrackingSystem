<?php

class RetrieveLabourDetailsCommunication extends Communication{
    private $LabourId;
    private $LabourActiveModel;

    public function __construct(){
        $this->LabourActiveModel = ModelCommon::loading_model('LabourActive');
        $this->resetSelf();
    }

    public function resetSelf(){
        $this->LabourId = null;
    }

    public function setDetails($params){
        if ($params['LabourId']){
            $this->LabourId = $params['LabourId'];
            return($this);
        }
        return false;
    }

    public function execute(){
        // no implementation
    }

    public function communicate($model){
        $labour = $this->LabourActiveModel->findByLabourId($this->LabourId);
        if(isset($labour->LabourId)){
            $model->Communication_result = $labour;
            $this->resetSelf();
            return(true);
        }
        return(false);
    }

    public function return()
    {
        // no implementation
    }
}