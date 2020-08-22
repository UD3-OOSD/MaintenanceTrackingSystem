<?php

class Forman extends Controller{

  private $service,$_approved,$_closed,$_deleted,$_expired,$_finished,$_init,$_started;
  private $serviceSystem;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
    $this->load_system('SystemService');

  }


  public function indexAction(){
    [$this->_init,$this->_approved,$this->_started,$this->_finished,$this->_expired,$this->_closed,$this->_deleted] = $this->SystemService->get();
    $this->view->render('forman/index');
  }

  public function approveAction($id = ''){
      //$id = $_POST['service_num'];
      if($id!= ''){
          dnd($this->SystemService->check($id));
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/approve');
          }
      }
      //display resposive table ($_init)
      $serviceData = $this->SystemService->get(1);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Accept','approve']);
      $this->view->render('forman/required');

  }

  public function closedAction($id=''){

      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/closed');
          }
      }

      //display resposive table ($_closed)
      $serviceData = $this->SystemService->get(6);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice']);
      $this->view->render('forman/closed');

  }

  public function deleteServiceAction($id=''){
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman');
          }
      }

      //display resposive table ($_deleted)
      Router::redirect('forman');
  }

  public function acceptedAction($id=''){
    #fetch data from busdb for accepted services and their headers. @devin @avishka.
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/accepted');
          }
      }

      //display resposive table ($_closed)
      $serviceData = $this->SystemService->get(3);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice']);
      $this->view->render('forman/accepted');

  }

  public function startedAction(){
      $serviceData = $this->SystemService->get(4);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice']);
      $this->view->render('forman/started');

  }

  public function closeAction($id = ''){
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/finished');
          }
      }
      $serviceData = $this->SystemService->get(5);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Close','close']);
      $this->view->render('forman/finished');

  }

  public function expiredAction(){
      $serviceData = $this->SystemService->get(7);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Renew','editService']);
      $this->view->render('forman/expired');

  }

  public function addServiceAction(){
      $validation = new Validate();
      $posted_values = ['ServiceType' => '', 'BusNumber' => '','ServiceInitiatedDate' => '','Labourers' => '','ServiceDescription' => ''];
      if ($_POST) {
          $posted_values = posted_values($_POST);
          $validation->check($_POST, [
              'BusNumber' => [
                  'display' => 'BusNumber',
                  'require' => true,
                  'unique' => 'bustable',
                  'min' => 8  #check
              ],
              'ServiceType' => [
                  'display' => 'Service Type',
                  'require' => true,
              ],
              'Labourers' => [
                  'display' => 'Labourers',
                  'require' => true,
                  'min' => 4,
              ],
              'ServiceInitiatedDate' => [
                  'display' => 'Start Date',
                  'require' => true
              ]
          ]);
          if ($validation->passed()) {
              $this->service = Service::getMultitance($this->_controller,'0');
              $this->service->getState()->fillAction($_POST);
              $this->service->set_trigger();
              $this->service->fillAction($_POST,'forman');
              $this->service->stateChange($this);
              Router::redirect('forman');
          }
      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('forman/service_form');#check with @nip and @uda

  }



  public function editServiceAction(){
      $service_num = $_POST['service_num'];
      $this->service = Service::getMultitance($this->_controller,'2');
      #dnd($this->service->getState());
      if($this->service->getState()->checkId($service_num) && ModelCommon::selectAllArray('activeservices','ServiceId',$service_num)){
          $this->service->stateChange($this);
          $details = $this->service->getState()->show($service_num);
          $this->view->displayErrors = '';
          $this->view->post = $details;

          $this->view->render('forman/service');
      }
      else{
          $this->view->displayarr1 = 'the entered Bus Number not in the system.';
          $this->view->displayarr2 = '';
          Router::redirect('forman');
      }

  }

  public function saveServiceAction(){
      //validation
      //save in the DB -> look Admin saveBusAction();
  }

  // show tables @nipun.


}
