<?php

class Clerk extends Controller{

  public function indexAction(){

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
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('clerk/index');
  }

  public function updateAction($data){  // connect to update button @uda
    $this->getState()->stateChange();
    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka
      $validation = new Validate();
      if(isset($_POST['Distance']) && isset($_POST['BusNumber'])) {
          $validation->check($_POST, [
              'BusNumber' => [
                  'display' => 'Vehicle Number',
                  'require' => true,
                  'unique' => 'bustable',
                  'min' => 8  #check
              ],
              'Distance' => [
                  'display' => 'Distance',
                  'require' => true,
                  'is_numeric' => true
              ]
          ]);
          if ($validation->passed()) {
              $bus = new Bus();
              $bus->updatedistance($_POST);
          }
      }
  }
}
