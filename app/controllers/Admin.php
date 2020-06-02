<?php

require_once(ROOT.DS.'app/controllers/bus/Bus.php');
require_once(ROOT.DS.'app/controllers/labour/Labour.php');

class Admin extends Controller{

  private $busses , $labours; // just assume or can to set seperate arrays to diff states. @avishka
  private $bus , $lab;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
  }

  public function indexAction(){

    $this->view->render('admin/index');
  }

  public function show_busses(){
    // just a example is below.
    foreach ($busses as $bus) {
      //here some JQuery and html padding.
      //$this->bus->show();
    }
  }

  public function show_labours(){
    // just a example is below.
    foreach ($labours as $labour) {
      //here some JQuery and html padding.
      //$this->labour->show();
    }
  }

  public function addNewBusAction(){  // this is call by button in the index page of Admin. @uda
    $validation = new Validate();
    $posted_values = ['BusNumber' => '', 'EngineNumber' => '','ManufacturedYear' => '','Colour' => '','Mileage' => '', 'BusCategory' => '' , 'RegistrationDate' => '','NumberOfSeats' => '',];
    if ($_POST){
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
        'BusNumber' => [
          'display' => 'BusNumber',
          'require' => true,
          'unique' => 'bustable',
          'min' => 8  #check
        ],
        'EngineNumber' => [
          'display' => 'Engine number',
          'require' => true,
          'unique' => 'bustable',
          'min' => 6,
        ],
        'ManufacturedYear' => [
          'display' => 'Manufactured Year',
          'require' => true,
          'min' => 4,
        ],
        'BusCategory' => [
          'display' => 'Model',
          'require' => true,
        ],
        'Colour' => [
          'display' => 'Colour',
          'require' => true,
        ],
        'Mileage' => [
          'display' => 'Mileage',
          'require' => true,
        ],
        'NumberOfSeats' => [
          'display' => 'NumberOfSeats',
          'require' => true,
        ],
        'RegistrationDate' => [
          'display' => 'Registration Date',
          'require' => true
        ]
      ]);
      if ($validation->passed()){
        $this->bus = Bus::getMultitance($this->controller_name);
        $this->bus->fillAction($_POST);
        Router::redirect('admin');
      }

    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('admin/bus_form');
  }

  public function addNewLabourAction(){  // this is call by button in the index page of Admin. @uda

    $validation = new Validate();
    $posted_values = ['fullName' => '', 'lastName' => '','nameWIn' => '','address' => '','title' => '', 'nic' => '' , 'email' => '','tel' => '',"gender" => '','race'=>'', 'religion'=>'' , 'dob'=>'' , 'acl'=>''];
    if ($_POST){
      #dnd($_POST);
      $posted_values = posted_values($_POST);
      #echo(isset($_POST['gender']));
      #dnd('-------');
      $validation->check($_POST,[
        'fullName' => [
          'display' => 'Full name',
          'require' => true,
        ],
        'lastName' => [
          'display' => 'Last Name',
          'require' => true,
        ],
        'nameWIn' => [
          'display' => 'Name with initials',
          'require' => true,
        ],
        'address' => [
          'display' => 'Address',
          'require' => true,
        ],
        'nic' => [
          'display' => 'NIC Number',
          'require' => true,
          'min' => 10,
          'max' => 12,
          'unique' => 'labourdetails'
        ],
        'email' => [
          'display' => 'Email',
          'require' => true,
        ],
        'tel' => [
          'display' => 'NumberOfSeats',
          'require' => true,
          'is_numeric' => true,
          'min' => 10
        ],
          'gender' => [
              'display' => 'Gender',
              'require' => true,
          ],
          'race' => [
              'display' => 'Race',
              'require' => true,
          ],
          'religion' => [
              'display' => 'Religion',
              'require' => true,
          ],
          'dob' => [
              'display' => 'Date Of Birth ',
              'require' => true
          ],
          'acl' => [
              'display' => 'Rank ',
              'require' => true
          ]
      ]);
      #dnd($validation->passed());
      if ($validation->passed()){
        $this->lab = Labour::getMultitance($this->controller_name);
        $this->lab->fillAction($_POST);
        Router::redirect('admin/index');
      }
    $this->view->render('admin/user_form');
    $thislab = Labour::getMultitance($this->controller_name);           //is this usefull??
  }
  $this->view->post = $posted_values;
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('admin/user_form');
}

  public function editBusAction(){  // call by button press @uda
    //add the validation @devin
    $bus_num = $_POST['bus_num'];
    //$details = LockedBus::getInstance()->fitAction($bus_num);

    $this->view->post = $details;
    $this->view->render('admin/bus');
  }

  public function editLabourAction(){
    $lab_id = $_POST['lab_id'];
    //$details = ActiveLockLabour::getInstance()->fitAction($lab_id);
    $this->view->post = $details;
    $this->view->render('admin/labour');
  }

  public function saveBusAction(){

    $validation = new Validate();
    $posted_values = ['BusNumber' => '', 'EngineNumber' => '','ManufacturedYear' => '','Colour' => '','Mileage' => '', 'BusCategory' => '' , 'RegistrationDate' => '','NumberOfSeats' => '',];
    if ($_POST){
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
          'EngineNumber' => [
              'display' => 'Engine number',
              'require' => true,
              'unique' => 'bustable',
              'min' => 6,
          ],
          'Colour' => [
              'display' => 'Colour',
              'require' => true,
          ],
          'Mileage' => [
              'display' => 'Mileage',
              'require' => true,
          ],
          'NumberOfSeats' => [
              'display' => 'NumberOfSeats',
              'require' => true,
          ]
      ]);
      if ($validation->passed()){
        #$bus_num = $_POST['bus_num'];
        if(isset($_POST['save'])){
          (EditingBus::getInstance())->fitAction($_POST);
          Router::redirect('admin/index');
        }
        else if(isset($_POST['delete'])){
          $this->deleteBus($bus_num);
        }
      }

    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('admin/bus_form');
  }

  public function saveLabourAction(){
    $validation = new Validate();
    //$posted_values = ['fullName' => '', 'lastName' => '','nameWIn' => '','address' => '','title' => '', 'nic' => '' , 'email' => '','tel' => '',"gender" => '','race'=>'', 'religion'=>'' , 'dob'=>'' , 'acl'=>''];
    if ($_POST){
      #dnd($_POST);
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
      // add validation layer @devin.
      ]);
      if ($validation->passed()){
        $nic = $_POST['nic'];
        if(isset($_POST['save'])){
          ActiveLabour::getInstance()->fitAction($nic);
          Router::redirect('admin/index');
        }
        else if(isset($_POST['delete'])){
          $this->deleteLabour($nic);
        }
      }
    $this->view->render('admin/user_form');
    $this->lab = Labour::getInstance();
  }
  $this->view->post = $posted_values;
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('admin/user_form');
  }

  public function deleteBus($bus){
    // jQuery code in here to fade @devin.
    $this->bus = LockedBus::getInstance()->set_trigger(true);
    $this->bus->stateChange();

  }

  public function deleteLabour($id){
    $this->lab = ActiveLabour::getInstance()->set_trigger(true);
    $this->lab->stateChange();
  }

  public function sendVarificationAction(){
    $email = $_POST['mail'];
    if(sendMail($email,"Verifycation mail ","You have registered in the Horana Deport",'https://www.google.com')){
      Router::redirect('admin/addNewLabour');
    }
  }
}
