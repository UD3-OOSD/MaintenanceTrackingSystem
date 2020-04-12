<?php

class Register extends Controller{

  public function __construct($controller, $action){
    parent::__construct($controller, $action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function loginAction(){
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
          'min' => 8
        ]
      ]);
      if ($validation->passed()) {
        $user = $this->UsersModel->findByUserName($_POST['username']);
        if ($user && password_verify(Input::get('passsword'), $user->password)) {
          $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
          $user->login($remember);
          Router::redirect('');
        }
      }else{
        $validation->addError("There is an error with your username or password.");
      }
    }
    $this->view->displayErrors = $validation->displayErrors();
    $this->view->render('register/login');
  }

  public function logoutAction(){
    if (currentUser()) {
      currentUser()->logout();
      Router::redirect('register/login');
    }  
  }
}
