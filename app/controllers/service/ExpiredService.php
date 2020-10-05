<?php

class ExpiredService implements ServiceState{

  private static $expservice = NULL;
  private static $ServiceActiveModel;

  private function __construct(){
      ExpiredService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(ExpiredService::$expservice)){
      ExpiredService::$expservice = new ExpiredService();
    }
    return ExpiredService::$expservice;
  }

  public function stateChange($service){
    if($service->get_trigger()){
      $service->setState('8');
      ExpiredService::$ServiceActiveModel->stateChange($service->getId(),8);
    }else{
      $service->setState('0');
      ExpiredService::$ServiceActiveModel->stateChange($service->getId(),0);
      $this->delete_data($service);
    }
  }

  public function delete_data($service){
    // delete date from form @devin @uda


      //whattttttt?????
  }

    public function getState()
    {
        // TODO: Implement getState() method.
    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }

    public function fillAction($params)
    { //not needed
        // TODO: Implement fillAction() method.
    }
}
