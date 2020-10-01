<?php


class NewDeactiveLabour implements LabourState{

  private static $newdelab = NULL;
  private static $LabourActiveModel;
  private static $UsersModel;

  private function __construct(){
    NewDeactiveLabour::$LabourActiveModel = ModelCommon::loading_model('LabourActive');
    NewDeactiveLabour::$UsersModel = ModelCommon::loading_model('Users');
  }

  public static function getInstance(){
    if(!isset(NewDeactiveLabour::$newdelab)){
      NewDeactiveLabour::$newdelab = new NewDeactiveLabour();
    }
    return NewDeactiveLabour::$newdelab;
  }

  public function stateChange($lab){
    $lab->setState('1');
  }

  public function fillAction($data){
        #dnd($data);
    $rand = md5(uniqid() + rand(0, 100));
    $hash = substr($rand,0,50);
    #dnd('works');
    #dnd('0i0ifhjfioehiohgreirhjgieprhjiep0jhri');
    $this->send_mail($data['fullName'],$data['email'],$hash);

    NewDeactiveLabour::$LabourActiveModel->registerNewLabouror($data);
    NewDeactiveLabour::$UsersModel->registerNewUser($data,$hash);
  }

  public function send_mail($name,$mail,$hash){
    sendMail($mail,
        'Verification key for register',
        '<h2> Hi '.$name.'</h2><h3>'.$hash.'</h3><p>this is the varifaction code to use in registration process.</p>',
        'https://www.google.com'); // has to change.
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


    public function fill($data)
    {
        // TODO: Implement fill() method.
    }
}
