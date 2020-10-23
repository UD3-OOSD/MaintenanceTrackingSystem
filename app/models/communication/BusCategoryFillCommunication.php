<?php
    class BusCategoryFillCommunication extends Communication{
        private $BusMSModel;
        private $BusNumber;
        private $ServiceId;
        private $ServiceActiveModel;

        public function __construct(){
            $this->BusMSModel = ModelCommon::loading_model('BusMS');
            $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
            $this->resetSelf();
    }

    public function resetSelf(){
        $this->BusNumber = null;
        $this->ServiceId = null;
    }


        public function execute(){
            $Bus = $this->BusMSModel->findByBusNumber($this->BusNumber);
            $BusCategory = $Bus->BusCategory;
            $service = $this->ServiceActiveModel->findByServiceId($this->ServiceId);
            $service->BusCategory = $BusCategory;
            $service->save();
            $this->resetSelf();
        }

    public function setDetails($params){
            $this->BusNumber = $params['BusNumber'];
            $this->ServiceId = $params['ServiceId'];
            return($this);
        }
    }