<?php

class Mechanic extends Controller{

  private $service,$_init,$_started;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
    $this->load_system('SystemService');
    $this->service = Service::getMultitance($this->_controller,'0');
  }

  public function indexAction(){

    //display tables
    [$this->_init,$this->_started] = $this->SystemService->get();
    $this->view->render('mechanic/index');
  }

  public function startAction($id = ''){
      #fetch data from busdb for accepted services and their headers. @devin @avishka.
      if($id != ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service->stateChange($this->service);
          }else{
              echo $id." is invalid.";
              Router::redirect('mechanic/start');
          }
      }

      //display resposive table ($_closed)
      $serviceData = $this->SystemService->get(3);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Start','start']);
      $this->view->render('mechanic/approved');
  }

  public function finishAction($id = ''){
      #fetch data from busdb for accepted services and their headers. @devin @avishka.
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service->stateChange($this->service);
          }else{
              echo $id." is invalid.";
              Router::redirect('mechanic/finish');
          }
      }

      //display resposive table ($_closed)
      $serviceData = $this->SystemService->get(4);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Finish','finish']);
      $this->view->render('mechanic/started');
  }

    public function editServiceAction(){
        $service_num = $_POST['service_num'];
        #dnd($this->_controller);
        $this->service = Service::getMultitance($this->_controller,'2');
        #dnd($this->service);
        if($this->service->getState()->checkId($service_num) && ModelCommon::selectAllArray('activeservices','ServiceId',$service_num)){
            $this->service->stateChange($this);
            $details = $this->service->getState()->show($service_num);
            $this->view->displayErrors = '';
            $this->view->post = $details;
            $this->view->render('mechanic/service');
        }
        else{
            $this->view->displayarr1 = 'the entered Bus Number not in the system.';
            $this->view->displayarr2 = '';
            Router::redirect('mechanic/index');
        }

    }

}
