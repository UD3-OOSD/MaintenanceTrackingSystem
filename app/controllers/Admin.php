<?php

require_once(ROOT.DS.'app/controllers/bus/Bus.php');
require_once(ROOT.DS.'app/controllers/labour/Labour.php');

class Admin extends Controller{

  private $busses , $labours; // just assume or can to set seperate arrays to diff states. @avishka
  private $bus , $lab;
  private $sysBus, $sysLab;

  public function __construct($controller_name,$action){
    parent::__construct($controller_name, $action);
    $this->load_system('SystemBus');
    $this->load_system('SystemLabour');
    $this->bus = Bus::getMultitance($this->_controller,'0');
    $this->lab = Labour::getMultitance($this->_controller,'0');
  }

  public function indexAction(){
      //dnd($this->sysBus);
    $busData = $this->SystemBus->get();
    #$labData = $this->SystemLabour->get();
    $busHead = ['BusId','BusNumber','BusCategory','EngineNumber','RegistrationDate'];
    //dnd(filter_attr($busData,['BusId','BusNumber','BusCategory','EngineNumber','RegistrationDate']));
    //Cookie::set('action','admin/editbus',100);
    Cookie::setList(['headers','data','action'],[listToString($busHead),filterToString($busData,$busHead),'admin-editBus']);
    //$this->view->labData = $labData;
    //$this->view->setLayout('option_1');
    //$this->view->table1 =
    $this->view->render('admin/index');


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
        $this->bus = Bus::getMultitance($this->_controller,'0');
        //dnd($this->bus->getState());
        $this->bus->getState()->fillAction($_POST);
        $this->bus->stateChange($this);
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
      $posted_values = posted_values($_POST);
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
      if ($validation->passed()){
        $this->lab = Labour::getMultitance($this->_controller,'0');
        $this->lab->getState()->fillAction($_POST);
        Router::redirect('admin');
      }
  }
  $this->view->post = $posted_values;
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('admin/user_form');
}

  public function editBusAction(){  // call by button press @uda
      //dnd('exists');
    //add the validation @devin
      #echo $_POST['bus_num'];
    $bus_num = $_POST['bus_num'];
    //$details = LockedBus::getInstance()->fitAction($bus_num);
    $this->bus = Bus::getMultitance($this->_controller,'1');
    #$this->bus->setTableState(3);//set state to '1' and in the checkId method stateChange();
      //dnd($this->bus->getState()->checkId($bus_num));
      #dnd($this->bus->getState()->checkId($bus_num) && ModelCommon::selectAllArray('bustable','BusNumber',$bus_num));
      if($this->bus->getState()->checkId($bus_num) && ModelCommon::selectAllArray('bustable','BusNumber',$bus_num)){
        //$this->bus->set_trigger();
        $this->bus->stateChange($this->bus);
        $details = $this->bus->getState()->show($bus_num);
        $this->view->displayErrors = '';
        $this->view->post = $details;

        //dnd($details);
        $this->view->render('admin/bus');
    }else{
        $this->view->displayarr1 = 'the entered Bus Number not in the system.';
        $this->view->displayarr2 = '';
        Router::redirect('admin');
    }
  }

  public function editLabourAction(){
    $lab_id = $_POST['lab_id'];
    //$details = ActiveLockLabour::getInstance()->fitAction($lab_id);
    $this->lab = Labour::getMultitance($this->_controller,'2');
    if($this->lab->getState()->checkId($lab_id) && ModelCommon::selectAllArray('labourdetails','nic',$lab_id)){
        $this->lab->stateChange($this);
        $details = $this->lab->getState()->show($lab_id);
        $this->view->displayErrors = '';
        $this->view->post = $details;
        $this->view->render('admin/labour');
    }else{
        $this->view->displayarr1 = '';
        $this->view->displayarr2 = 'the entered Labour NIC number not in the system.';
        Router::redirect('admin');
    }

  }

  public function saveBusAction(){
      //dnd($_POST);

    $validation = new Validate();
    $posted_values = ['BusNumber' => '', 'EngineNumber' => '','ManufacturedYear' => '','Colour' => '','Mileage' => '', 'BusCategory' => '' , 'RegistrationDate' => '','NumberOfSeats' => '',];

    if ($_POST){
        if(isset($_POST['save'])) {
            $posted_values = posted_values($_POST);
            $validation->check($_POST, [
                'EngineNumber' => [
                    'display' => 'Engine number',
                    'require' => true,
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
            if ($validation->passed()) {
                #$bus_num = $_POST['bus_num'];
                $this->bus = Bus::getMultitance($this->_controller, '2');

                $this->bus->getState()->updateDetails($_POST);
                $this->bus->stateChange($this);
                Router::redirect('admin');
            }
        }

        if(isset($_POST['delete'])){
            $this->bus = Bus::getMultitance($this->_controller, '1');
            $this->bus->set_trigger();
          $this->bus->stateChange($this);
          //dnd($this->bus->getState());
          $this->bus->getState()->delete($_POST['BusNumber']);
          $this->view->displayarr1  = $this->view->displayarr2 = '';
          Router::redirect('admin');
        }

    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('admin/bus');
  }

  public function saveLabourAction(){
    $validation = new Validate();
    //$posted_values = ['fullName' => '', 'lastName' => '','nameWIn' => '','address' => '','title' => '', 'nic' => '' , 'email' => '','tel' => '',"gender" => '','race'=>'', 'religion'=>'' , 'dob'=>'' , 'acl'=>''];
    if ($_POST){
      #dnd($_POST);
        if(isset($_POST['save'])) {
            $posted_values = posted_values($_POST);
            $validation->check($_POST, [
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
                'nic' => [
                    'display' => 'NIC Number',
                    'require' => true,
                    'min' => 10,
                    'max' => 12,
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
            if ($validation->passed()) {
                //$nic = $_POST['nic'];
                $this->lab = Labour::getMultitance($this->_controller, '3');

                $this->lab->getState()->updateDetails($_POST);
                $this->lab->stateChange($this);
                Router::redirect('admin');
            }
        }
        if(isset($_POST['delete'])){
            //dnd($_POST);
            $this->lab = Labour::getMultitance($this->_controller, '2');
          $this->lab->set_trigger();
          $this->lab->stateChange($this);
          $this->lab->getState()->delete($_POST['nic']);
          $this->view->displayarr1  = $this->view->displayarr2 = '';
          Router::redirect('admin');
        }

  }
  $this->view->post = $posted_values;
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('admin/labour');
  }

  public function deleteBus($bus){
    // jQuery code in here to fade @devin.
    $bus = LockedBus::getInstance()->set_trigger(true);
    $bus->stateChange();


  }

  public function deleteLabour($id){
    $lab = ActiveLabour::getInstance()->set_trigger(true);
    $lab->stateChange();
  }

  public function sendVarificationAction(){
    $email = $_POST['mail'];
    if(sendMail($email,"Verifycation mail ","You have registered in the Horana Deport",'https://www.google.com')){
      Router::redirect('admin/addNewLabour');
    }
  }

  public function redirAction(){}
}
