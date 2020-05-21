<?php

class InitService extends Controller implements ServiceState{

  private static $initservice = NULL;

  private function __construct(){
    $this->load_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(InitService::$initservice)){
      InitService::$initservice = new InitService();
    }
    return InitService::$initservice;
  }

  public function stateChange($service){
      if($service->get_trigger()){
          $service->setState(ApprovedService::getInstance());
      }else{
          $service->setState(DeletedService::getInstance());
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



    public function TableUpdate(){

    }
}
