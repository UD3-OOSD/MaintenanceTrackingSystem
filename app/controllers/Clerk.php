<?php

class Clerk extends Controller{

  private $bus;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
      $this->load_system('SystemLabour');
      $this->load_system('SystemBus');
      $this->bus = Bus::getMultitance($this->_controller,'0');
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
      $data = $this->SystemLabour->getLabour(Session::get('user-id'));
      $posting_list = ['img_path'=> $data->img_path, 'id'=> $data->LabourId, 'name'=> $data->fullName, 'telNo'=> $data->tel, 'Address'=> $data->address];
      $this->view->post = $posting_list;
      $this->view->render('clerk/index');
  }

  public function updateAction(){  // connect to update button @uda

    //get data relate to bus_id and create $bus obj. and call it's action. @devin @avishka
      $validation = new Validate();
      $posted_values = ['reg_no' => '', 'mileage' => ''];
      //dnd($_POST);
      if($_POST) {
          $posted_values = posted_values($_POST);
          $validation->check($_POST, [
              'reg_no' => [
                  'display' => 'Registration No.',
                  'require' => true,
              ],
              'mileage' => [
                  'display' => 'Mileage',
                  'require' => true,
                  'positive' => true
              ]
          ]);
          if ($validation->passed()) {
              #dnd($this->SystemBus->update_distance($_POST['reg_no'],$_POST['mileage']));
            if(!$this->SystemBus->update_distance($_POST['reg_no'],$_POST['mileage'])){
                $this->view->post = $posted_values;
                $this->view->displayErrors = '<ul class="bg-danger">'.'<li class="text-danger">bus number is invalid.</li>'.'</ul>';
                $this->view->render('clerk/update');
            }
            Router::redirect('clerk/update');
          }
      }
      $this->view->post = $posted_values;
      $this->view->displayErrors = $validation->displayErrors();
      $this->view->render('clerk/update');
  }
}
