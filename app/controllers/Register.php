<?php

class Register extends Controller{

  public function __construct($controller, $action){
    parent::__construct($controller, $action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function loginAction(){
    #echo password_hash('password', PASSWORD_DEFAULT);
    if($_POST){
      //form InvalidArgumentException
      $validation = true;
      if ($validation === true) {
        $user = $this->UsersModel->findByUserName($_POST['username']);
        if ($user && password_verify(Input::get('passsword'), $user->password)) {
          $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
          $user->login($remember);
          Router::redirect('');
        }
      }
    }
    $this->view->render('register/login');
  }
}
