<?php

class Forman extends Controller{

  private $service;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
  }



  public function indexAction(){

    $this->view->render('forman/index');
  }

  public function CloseServiceAction($id){
      $this->service = Service::getMultitance($this->_controller,'2');
      if($this->service->getState()->checkId($id)){
          $this->service->setState('6');
          $this->service->getState()->saveState($id);
      }
      $this->view->render('forman/index');
  }

  public function deleteServiceAction($id){
    $this->service = Service::getMultitance($this->_controller,'2');
    if($this->service->getState()->checkId($id)){
        $this->service->setState('8');
        $this->service->getState()->saveState($id);
    }
    $this->view->render('forman/index');
  }

  public function acceptServiceAction($id){
    #fetch data from busdb for accepted services and their headers. @devin @avishka.
    $this->service = Service::getMultitance($this->_controller,'2');
    if($this->service->getState()->checkId($id)){
        $this->service->setState('3');
        $this->service->getState()->saveState($id);
    }
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
              Router::redirect('forman');
          }
      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('forman/service_form');#check with @nip and @uda

  }

  public function editServiceAction(){

  }



  // show tables @nipun.


}
