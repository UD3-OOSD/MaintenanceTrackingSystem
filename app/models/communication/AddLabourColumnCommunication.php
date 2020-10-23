<?php

class AddLabourColumnCommunication extends Communication{
    private $ServiceMatrixModel;
    private $LabourId;

    public function __construct(){
        $this->ServiceMatrixModel = ModelCommon::loading_model('ServiceMatrics');
        $this->resetSelf();
    }

    function resetSelf(){
        $this->LabourId = null;
    }

    function setDetails($params){
        $this->LabourId = $params['LabourId'];
        return($this);
    }

    function execute(){
        $this->ServiceMatrixModel->addLabour($this->LabourId);
        $this->resetSelf();
    }
}