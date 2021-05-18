<?php

class GetImagePathCommunication extends Communication{
    private $LabourId;
    private $LabourActiveModel;

    public function __construct(){
        $this->LabourActiveModel = ModelCommon::loading_model('LabourActive');
        #dnd($this->LabourActiveModel);
        $this->resetSelf();
    }

    public function resetSelf(){
        $this->LabourId = null;
    }

    public function setDetails($params){
        if (isset($params['LabourId'])){
            $this->LabourId = $params['LabourId'];
            return($this);
        }
        return false;
    }

    public function execute(){
        // no implementation
    }

    public function return(){
        $profile = $this->LabourActiveModel->findByLabourId($this->LabourId);
        if(isset($profile->img_path)){
            $this->resetSelf();
            return $profile->img_path;
        }
        return false;
    }

    function communicate($model){
        // no implementation
    }
}