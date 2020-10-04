<?php

class Register extends Controller{

  public function __construct($controller, $action){
    parent::__construct($controller, $action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function loginAction(){
    #echo password_hash('password', PASSWORD_DEFAULT);
    $validation = new Validate();
    #echo password_hash('password', PASSWORD_DEFAULT);
    if($_POST){
      //form InvalidArgumentException
      $validation->check($_POST, [
        'username' => [
          'display' => 'Username',
          'require' => true
        ],
        'password' => [
          'display' => 'Password',
          'require' => true,
          'min' => 6
        ]
      ]);
      if ($validation->passed()) {
        #echo($_POST['username']);
        $user = $this->UsersModel->findByUserName($_POST['username']);
        $acl = $user->acl;
        $id = $user->LabourId;
        #(password_verify(Input::get('password'), $user->password))? $v= "it's working." : $v = "it's not working";
        //echo Input::get('password') . ' '. $user->password;
        //dnd($user);
        #$labourmodel = new LabourActive();
        #$servicematrix = new ServiceMatrics();
        #$labours = $labourmodel->selectAllArray('deleted',0,$filter=false);
        #foreach ($labours as $labour){
        #    $servicematrix->addLabour($labour['LabourId']);
        #}
        #$servicemodel = new ServiceActive();
        #$servicemodel->checkAll();
        #}
        #$System = new SystemService();
        #$System->checkSpecificLab('Lab3',1);
        #dnd('done');
            #$servicematrics->addservice($lab['LabourId']);
        #}
          /*
        $services = $servicemodel->selectAllArray('deleted',1,$filter=false);
        foreach($services as $service){
            $labourers = $service['Labourers'];
            if($labourers){
                $labourers=trim($labourers);
                $labourers = explode(",",$labourers);
                $result = [];
                $result['ServiceId'] = $service['ServiceId'];
                foreach ($labourers as $labourer){
                    $result[$labourer] = $service['ServiceState'];
                }
                $servicematrix->addService($result);
            }
        }*/


         # ModelCommon::addColumn('users','VerificationKey',"VARCHAR(255)");
        if ($user&& password_verify(Input::get('password'),$user->password )) {
            $this->load_model('Users',$acl);
            $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;

            $this->UsersModel->login($id,$remember);
            Session::set('user-id',$id);
            #echo($category);
            #$usercheck = $this->UsersModel->verification_check('d1fe173d08e959397adf34b1d77e88d7');
            #dnd($usercheck);
            Router::redirect(strtolower($acl));
        }else{
          $validation->addError("There is an error with your username or password.");
        }
      }
    }
      #$this->view->post = ['username'=> '', 'password'=> ''];
  $this->view->displayErrors = $validation->displayErrors();
  $this->view->render('register/login');
  }

  public function logoutAction(){
    if (currentUser()) {
      currentUser()->logout();
      Router::redirect('register/login');
    }
  }

  public function validateAction(){
      $validation = new Validate();
      $this->view->displayErrors = '';
      if($_POST){
          $validation->check($_POST,[
              'val_key' => [
                  'display' => 'val_key',
                  'require' => true,
              ]
          ]);
          if($validation->passed()){
              $res = $this->UsersModel->verification_check($_POST['val_key']);
              #dnd($res);
              if($res == ""){
                  $this->view->displayErrors = '<ul class="bg-danger">'.'<li class="text-danger">Verification key is invalid.</li>'.'</ul>';
                  #$this->view->render('register/validation');
              }else{
                  #dnd($res);
                  Router::redirect('Register/register/'.$res);
              }

          }else{
          $this->view->displayErrors = $validation->displayErrors();}
      }
      $this->view->render('register/validation');
  }

  public function registerAction($values=''){
    #dnd($values);
    $validation = new Validate();
    $posted_values = ['lab_id' => '', 'acl'=>'', 'email'=>'','username'=> '', 'password'=>'', 'confirm'=> ''];
    if ($_POST) {
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
        'lab_id' => [
          'display' => 'lab_id',
          'require' => true
        ],
        'username' => [
          'display' => 'Username',
          'require' => true,
          'unique' => 'users',
          'min' => 6,
          'max' => 150
        ],
        'email' => [
          'display' => 'Email',
          'require' => true,
          'max' => 150,
          'valid_email' => true
        ],
        'password' => [
          'display' => 'Password',
          'require' => true,
          'min' => 6
        ],
        'confirm' => [
          'display' => 'Confirm Password',
          'require' => true,
          'matches' => 'password'
        ]
      ]);

      if ($validation->passed()) {
        $newUser = new Users($_POST['lab_id']);
        $newUser->completeNewUser($_POST);
        Router::redirect('');
      }
    }
    if($values != ""){
        $val_lis = explode(" ",$values);
        #dnd($val_lis);
        $posted_values = ['lab_id' => $val_lis[1] , 'acl'=> $val_lis[0], 'email'=> $val_lis[2],'username'=> '', 'password'=>'', 'confirm'=> ''];
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/register');
  }
}
