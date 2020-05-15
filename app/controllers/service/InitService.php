<?php

class InitService extends Controller implements ServiceState{

    public function __construct($service,$data,$id){
        $this->load_model('ServiceActive');
    }
    public function stateChange($service){
        if($service->get_trigger()){
            $service->setState(new ApprovedService());
        }else{
            $service->setState(new DeletedService());
        }
    }

  public function edit($service, $data){
    $service->setAttrs($data);
    $this->TableUpdate($data);
  }

    public function getState(){
      return('InitService');
        // TODO: Implement getState() method.
    }

    public function allServicesByState($state)
    {
        $this->ServiceActiveModel->allServicesByState($state);
        // TODO: Implement allServicesByState() method.
    }

    public function TableUpdate(){

    }
}
