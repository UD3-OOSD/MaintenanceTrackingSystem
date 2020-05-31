<?php

class Forman extends Controller{

  private $service;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
  }

  public function setOnService($service){
    $this->service = $service;
  }



  public function indexAction(){

    $this->view->render('forman/index');
  }

  public function approveAction(){
    //get service_id from url and fetch its' service obj. @avishka, @devin
    // $data by url.
    $service->getState()->edit($service,$data);
    $this->view->render('forman/index');
  }

  public function deleteAction(){
    //get service_id from url and fetch its' service obj. @avishka, @devin
    // $data by url.
    $service->stateChange();
    $this->view->render('forman/index');
  }

  public function acceptedAction(){
    #fetch data from busdb for accepted services and their headers. @devin @avishka.
    $heads = ['bus id','service id','service category'];
    $lis = [[001,156,'Engine'],[002,225,'tires'],[003,063,'Full service']];
    $links = ['index','',''];
    $this->view->table_1 = displaylinkedtable($heads,$lis,$links);
    $this->view->render('forman/accepted');
  }

  public function showAction($id){
    //fetch data by model on $id @devin. => $data;

  }
  public function addService(){
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
              $service = Service::getInstance();
              $service->set_trigger();
              $service->fillAction($_POST,'forman');
              Router::redirect('forman');
          }
      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('forman/service_form');#check with @nip and @uda

  }

  public function editAction(){

  }



  // show tables @nipun.


}
