<?php

class ApprovedService implements ServiceState{

  private static $appservice = NULL;

  private function __construct(){

  }

  public static function getInstance(){
    if(!isset(ApprovedService::$appservice)){
      ApprovedService::$appservice = new ApprovedService();
    }
    return ApprovedService::$appservice;
  }

  public function stateChange($service){
    if(!$service->get_time_trigger()){
      if($service->get_trigger){
        $service->setState(DeletedService::getInstance());
      }else{
        $service->setState(StartedService::getInstance());
      }
    }else{
      $service->setState(ExpiredService::getInstance());
    }
  }

  public function saveState($id){
      //@devin.
      //save the state as '3' in $id.
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
    {
        // TODO: Implement fillAction() method.
    }
}
