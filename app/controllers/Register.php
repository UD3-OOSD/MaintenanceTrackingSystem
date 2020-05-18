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
        #(password_verify(Input::get('password'), $user->password))? $v= "it's working." : $v = "it's not working";
        #echo Input::get('password') . ' '. $user->password;
        #echo $user->password;

        #$tables=['user_sessions','users'];
        #$keys = ['user_id','UserId'];
        #$params = ['UserId','email','session','user_agent'];

        #$results=ModelCommon::getColumnNames('bustable');
        #$results=$user->getColumnNames('buscategory');
        #$results=$user->LeftJoinSpecific($tables,$keys,$params,['UserId' => $user->UserId]);
        #echo($results->UserId);
        #echo(implode('    |||',$results));
        #echo($results);
          #ModelCommon::addColumn('activeservices','test','VARCHAR(80)');
          #ModelCommon::UpdateRow('users',['username'=>'test0005'],['email'=>'donthackmeplease1710@gmail.com','fname'=>'Devin']);
        #$user->addColumn('test','VARCHAR(80)');
        #ModelCommon::find('bustable',['conditions'=>'BusId=?','bind'=>[2]]);
        #echo('<br>');
        #echo($user&& password_verify(Input::get('password'),$user->password ));
        #dnd('..............................');
        if ($user&& password_verify(Input::get('password'),$user->password )) {
          $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
          $category = $user->login($remember);
          # echo($category);
          #dnd('...............');
          Router::redirect(strtolower($category));
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

  public function registerAction(){
    $validation = new Validate();
    $posted_values = ['name' => '', 'acl'=>'', 'email'=>'','username'=> '', 'password'=>'', 'confirm'=> ''];
    if ($_POST) {
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
        'name' => [
          'display' => 'Name',
          'require' => true
        ],
        'acl' => [
          'display' => 'acl',
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
          'unique' => 'users',
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
        $newUser = new Users();
        $newUser->registerNewUser($_POST);
        $newUser->login();
        Router::redirect('');
      }
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/register');
  }
}
