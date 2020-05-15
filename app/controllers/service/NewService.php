<?php

class NewService extends Controller implements ServiceState{

  public function __construct($service,$data,$id){
      $this->load_model('ServiceActive');

      $data=mergeData(['ServiceId'=> $id],$data);
      $service->setAttr($data);

      $service->stateChange();
      $this->fillAction($data,$service->getState());

  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState(new ApprovedService());
    }else{
      $service->setState(new InitService());
    }
  }


  public function getState()
  {
      // TODO: Implement getState() method.
      return('NewService');
  }


  public function fillAction($data,$state){
      $data=mergeData(['ServiceId'=> $state],$data);
      $this->ServiceActiveModel->registerNewService($data);
  }

  public function allServicesByState($state)
  {
      $this->ServiceActiveModel->allServicesByState($state);
      // TODO: Implement allServicesByState() method.
  }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method Add Error.
    }
}
