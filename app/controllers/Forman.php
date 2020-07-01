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

  public function ApproveAction($id=''){
      if($id!= ''){
          $var = $this->SystemService->check($id);
          if($var) {
              $this->service = $var;
              $this->service->stateChange($this);
          }else{
              echo $id." is invalid.";
              Router::redirect('forman/required');
          }
      }
      //display resposive table ($_init)
      $this->view->render('forman/required');
  }

  public function CloseServiceAction($id=''){

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

  public function acceptServiceAction($id=''){
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
    $this->view->render('forman/accepted');
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



  public function editServiceAction($id){
      $var = $this->SystemService($id);
      if($var){
          $this->service = $var;
          //show
      }else{
          echo $id." is not valid.";
          Router::redirect(forman);
      }
  }

  public function saveServiceAction(){
      //validation
      //save in the DB -> look Admin saveBusAction();
  }

  // show tables @nipun.


}
