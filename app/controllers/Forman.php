<?php

class Forman extends Controller{

  private $service,$_approved,$_closed,$_deleted,$_expired,$_finished,$_init,$_started;
  private $serviceSystem;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
    $this->load_system('SystemService');
    $this->load_system('SystemLabour');
    $this->service = Service::getMultitance($this->_controller,'0');
  }


  public function indexAction(){
      $data = $this->SystemLabour->getLabour(Session::get('user-id'));
      $this->SystemService->checkService();
      $posting_list = ['img_path'=> $data->img_path, 'id'=> $data->LabourId, 'name'=> $data->fullName, 'telNo'=> $data->tel, 'Address'=> $data->address];
      $this->view->post = $posting_list;
      $this->view->render('forman/index');
  }

  public function approveAction($id = ''){
      //$id = $_POST['service_num'];
      if($id!= ''){
          #dnd($this->SystemService->check($id));
          $var = $this->SystemService->check($id);
          if($var) {
              $service = Service::getMultitance('Forman','1');
              $service->setId($id);
              $service->getState()->stateChange($service);
              $this->SystemService->updateServicesMetrics($id);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/approve');
          }
      }
      //display resposive table ($_init)
      //dnd($this->SystemService->get(1));
      $serviceData = $this->SystemService->get(1);
      #dnd($serviceData);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice','Accept','approve']);
      $this->view->render('forman/required');

  }

  public function closedAction($id=''){

      //display resposive table ($_closed)
      $serviceData = $this->SystemService->get(6);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'viewservice']);
      $this->view->render('forman/closed');

  }

  public function deleteServiceAction($id=''){
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $service = Service::getMultitance('Forman','1');
              $service->setId($id);
              $this->service->set_trigger(0);
              $service->getState()->stateChange($service);
              $this->service->set_trigger(1);
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
              $service = Service::getMultitance('Forman','3');
              $service->setId($id);
              $service->getState()->stateChange($service);
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
      Cookie::setList(['headers','data','action'],[listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'viewservice']);
      $this->view->render('forman/started');

  }

  public function finishedAction($id = ''){
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              //$this->service->stateChange($this->service);
              $service = Service::getMultitance('Forman','5');
              $service->setId($id);
              $service->getState()->stateChange($service);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/finished');
          }
      }
      $serviceData = $this->SystemService->get(5);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action','buttonName','buttonAction'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'viewservice','Close','finished']);
      $this->view->render('forman/finished');

  }

  public function expiredAction(){
      $serviceData = $this->SystemService->get(7);
      $serviceHeads = ['ServiceId','ServiceType','BusNumber','ServiceDate'];
      Cookie::setList(['headers','data','action'], [listToString($serviceHeads),filterToString($serviceData,$serviceHeads),'editservice']);
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
                  'display' => 'Service Initiated Date',
                  'require' => true,
                  'date_future' => true,
              ]
          ]);
          if ($validation->passed()) {
              $this->service = Service::getMultitance($this->_controller,'0');
              $this->service->getState()->fillAction($_POST);
              $this->service->set_trigger();
              #$this->service->fillAction($_POST,'forman');
              $this->service->stateChange($this->service);
              Router::redirect('forman');
          }
      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('forman/service_form');#check with @nip and @uda

  }

  public function viewServiceAction(){
      $service_num = $_POST['service_num'];
      #dnd($_POST);
      $service = Service::getMultitance($this->_controller,'2');
      $service->setId($service_num);
      if($service->getState()->checkId($service_num) && ModelCommon::selectAllArray('activeservices','ServiceId',$service_num)){
          $details = $service->getState()->show($service_num);
          $this->view->displayErrors = '';
          $this->view->post = $details;
          //dnd($details);
          $this->view->render('forman/service_view');
      }
      else{
          $this->view->displayarr1 = 'the entered Service number not in the system.';
          $this->view->displayarr2 = '';
          Router::redirect('forman');
      }
  }

  public function editServiceAction(){

      $service_num = $_POST['service_num'];
      #dnd($_POST);
      $service = Service::getMultitance($this->_controller,'2');
      $service->setId($service_num);
      if($service->getState()->checkId($service_num) && ModelCommon::selectAllArray('activeservices','ServiceId',$service_num)){
          $details = $service->getState()->show($service_num);
          $this->view->displayErrors = '';
          $this->view->post = $details;
          //dnd($details);
          $this->view->render('forman/service');
      }
      else{
          $this->view->displayarr1 = 'the entered Service number not in the system.';
          $this->view->displayarr2 = '';
          Router::redirect('forman');
      }

  }

  public function saveServiceAction(){
      $validation = new Validate();
      $posted_values = ['ServiceId' => '', 'BusNumber' => '','serviceType' => '','Labourers' => '','ServiceInitialDate' => ''];

      if ($_POST){
          if(isset($_POST['save'])) {
              $posted_values = posted_values($_POST);
              $validation->check($_POST, [
                  'ServiceId' => [
                      'display' => 'ServiceId',
                      'require' => true,
                  ],
                  'BusNumber' => [
                      'display' => 'BusNumber',
                      'require' => true,
                      'min' => 8  #check
                  ],
                  'ServiceType' => [
                      'display' => 'ServiceType',
                      'require' => true,
                  ],
                  'Labourers' => [
                      'display' => 'Labourers',
                      'require' => true,
                  ],
                  'ServiceInitialDate' => [
                      'display' => 'ServiceInitialDate',
                      'require' => true,
                      'date_future' => true,
                  ]
              ]);
              if ($validation->passed()) {
                  #$bus_num = $_POST['bus_num'];
                  $service = Service::getMultitance($this->_controller, '2');
                  $service->setId($_POST['ServiceId']);
                  $service->getState()->updateDetails($_POST);
                  $service->stateChange($this);
                  Router::redirect('forman');

              }
              else{
                  $this->view->post = $posted_values;
                  $this->view->displayErrors = $validation->displayErrors();
              }
          }
          if(isset($_POST['delete'])){
              $service = Service::getMultitance($this->_controller, '1');
              $service->setId($_POST['ServiceId']);
              //Service::setId($_POST['ServiceId']);
              $service->set_trigger(0);
              $service->stateChange($this);
              $service->getState()->delete($_POST['ServiceId']);
              $this->view->displayarr1  = $this->view->displayarr2 = '';
              Router::redirect('forman');
          }


      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('forman/service');
      //validation
      //save in the DB -> look Admin saveBusAction();
  }

  // show tables @nipun.


}
