<?php

    class FindBusIdFromBusNumberCommunication extends Communication {
        private $BusNumber;
        private $BusMSModel;

        public function __construct(){
            $this->BusMSModel = ModelCommon::loading_model('BusMS');
            $this->resetSelf();
        }

        public function resetSelf(){
            $this->BusNumber = null;
        }

        public function setDetails($params){
            $this->BusNumber = $params['BusNumber'];
            return($this);
        }

        public function execute(){
            /// no implementation
        }

        public function communicate($model){
            $details = $this->BusMSModel->findByBusNumber($this->BusNumber);
            if(isset($details->BusId)){
                $model->Communication_result = $details->BusId;
                $this->resetSelf();
                return(true);
            }
            return (false);
        }

        function return()
        {
            // no implementation
        }
    }