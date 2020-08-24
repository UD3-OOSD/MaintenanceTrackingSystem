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
    $this->view->displayErrors = '';
    $this->view->render('clerk/index');
  }

  public function updateAction(){  // connect to update button @uda

    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka
      $validation = new Validate();
      //dnd($_POST);
      if($_POST) {
          $validation->check($_POST, [
              'reg_no' => [
                  'display' => 'Registration No.',
                  'require' => true,
                  'min' => 8  #check
              ],
              'mileage' => [
                  'display' => 'Mileage',
                  'require' => true,
                  'is_numeric' => true
              ]
          ]);
          if ($validation->passed()) {
            // there must be a creation pattern.
            $this->bus = Bus::getMultitance($this->_controller,'1');
             // dnd($this->bus->getState());
            //dnd(ModelCommon::selectAllArray('bustable','BusNumber',$_POST['reg_no']));
              //dnd(ModelCommon::selectAllArray('bustable','BusNumber',$_POST['reg_no']));
            if($this->bus->getState()->checkId($_POST['reg_no']) && ModelCommon::selectAllArray('bustable','BusNumber',$_POST['reg_no'])['deleted']==0) {
                $this->bus->stateChange($this);
                //dnd($this->bus->getState());
                $this->bus->getState()->updateDistance($_POST['reg_no'], $_POST['mileage']);
                $this->bus->stateChange($this);
            }
          }
      }
  }
}
