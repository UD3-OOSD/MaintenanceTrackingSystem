<?php

class Clerk extends Controller{

  private $bus;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
  }

  public function indexAction(){
    /*
    $validation = new Validate();
    $posted_values = [];
    if($_POST){
      $validation->check($_POST,[]);
      $posted_values = posted_values($_POST);
      if($validation->passed()){
        $posted_values = []; //this will reset the array to show empty boxs.
      }
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();*/
    $this->view->render('clerk/index');
  }

  public function updateAction($data){  // connect to update button @uda

    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka
      $posted_values = ['Bus'];
      $validation = new Validate();
      if($_POST) {
          $validation->check($_POST, [
              'BusNumber' => [
                  'display' => 'Vehicle Number',
                  'require' => true,
                  'min' => 8  #check
              ],
              'Distance' => [
                  'display' => 'Distance',
                  'require' => true,
                  'is_numeric' => true
              ]
          ]);
          if ($validation->passed()) {
            // there must be a creation pattern.
            $this->bus = Bus::getMultitance($this->_controller,'1');
            if($this->bus->getState()->checkId($_POST['BusNumber']) && ModelCommon::selectAllArray('bustable','BusNumber',$_POST['BusNumber'])[0]['deleted']==0){
                $this->bus->stateChange($this);
                $this->bus->getState()->updateDistance($_POST['BusNumber']);
                $this->bus->stateChange($this);
            }
          }
      }
  }
}
