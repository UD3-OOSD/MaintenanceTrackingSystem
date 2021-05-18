<?php

class RemoveAllServicesOfBus extends Communication{
    private $BusNumber;
    private $ServiceActiveModel;

    public function __construct(){
        $this->ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
        $this->resetSelf();
    }
    public function resetSelf(){
        $this->BusNumber = null;
    }

    public function setDetails($params){
        #dnd($params);
        $this->BusNumber = $params['BusNumber'];
        #dnd($this);
        return ($this);
    }

    public function execute(){
        #dnd(ModelCommon::loading_model('ServiceActive'));
        $services = $this->ServiceActiveModel->find(['conditions' => ['BusNumber = ?','deleted = ?'],'bind'=>[$this->BusNumber,0]]);
        #dnd($services);
        if(!empty($services)){
            foreach ($services as $service){
                #dnd($service->getDeleteOption());
                if($service->getDeleteOption()){
                    $service->deleted = 1;
                    #dnd($service);
                    $service->save();
                }else{
                    $service->delete($this->BusNumber,'BusNumber');
                }
            }
        }
        #dnd('fuck');
        $this->resetSelf();
    }

    public function communicate($model){
        // TODO: Implement communicate() method.
    }

    public function return(){
        // TODO: Implement return() method.
    }
}