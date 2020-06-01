<?php

require_once(ROOT.DS.'app'.DS.'controllers'.DS.'labour'.DS.'LabourState.php');


class NewDeactiveLabour implements LabourState{

  private static $newdelab = NULL;
    private $LabourActiveModel;
    private $UsersModel;

    private function __construct(){
    $this->LabourActiveModel = ModelCommon::loading_model('LabourActive');
    $this->UsersModel = ModelCommon::loading_model('Users');
  }

  public static function getInstance(){
    if(!isset(NewDeactiveLabour::$newdelab)){
      NewDeactiveLabour::$newdelab = new NewDeactiveLabour();
    }
    return NewDeactiveLabour::$newdelab;
  }

  public function stateChange($lab){
    $lab->setState(NewActiveLabour::getInstance());
  }

  public function fill($data){
        #dnd($data);
    $this->LabourActiveModel->registerNewLabouror($data);
    #dnd('works');
    #dnd('0i0ifhjfioehiohgreirhjgieprhjiep0jhri');
   # $this->send_mail($data['fullName'],$data['email']);

    $this->UsersModel->registerNewUser($data);
  }

  public function send_mail($name,$mail){
    sendMail($mail,$header,$message,$link); // has to change.
    //send verification key in a email. @avishka
    //gerate it -> save it in the db
    // send url also.  @devin
  }

  public function loadActivatePage($id){ // this $id will auto feed by Router.
    //this is the method handle activation. @devin
    // load $lab by $_POST['id']   @avishka
    $this->checkValidation($id);
    //if invalide key.
    $this->view->render('validation');
    //else
    $this->stateChange($lab);
    $lab->getState()->edit();

  }

  public function checkValidation($id){
    //fetch data. @avishka
  }


}
