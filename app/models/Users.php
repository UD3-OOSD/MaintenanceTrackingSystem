<?php

class Users extends Model{
  private $_isLoggedIn, $_sessionName, $_cookieName;
  public static $currentLoggedInUser = null;

  public function __construct($user = '',$acl='Other'){
    $table = 'users';
    parent::__construct($table,'Users',$acl);
    $this->_sessionName = CURRENT_USER_SESSION_NAME;
    $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
    $this->_softDelete = true;
    if ($user != '') {
      if (substr($user,0,3)=='Lab') {
        $u = $this->_db->findFirst('users', ['conditions'=>'LabourId = ?', 'bind'=>[$user]]);
      }else{
        $u = $this->_db->findFirst('users', ['conditions'=>'username = ?', 'bind'=>[$user]]);
        #echo($user);
      }
      if ($u) {
        foreach ($u as $key => $value) {
          $this->$key = $value;
        }
      }
    }
  }

  public function findByUserName($username){
    #echo(($this->findFirst(['conditions'=>'username = ?', 'bind'=>[$username]]))->UserId);
    return $this->findFirst(['conditions'=>'username = ?', 'bind'=>[$username]]);
  }

  public function login($id,$rememberMe = false){
    Session::set($this->_sessionName, $id);
    if ($rememberMe) {
      $hash = md5(uniqid() + rand(0, 100));
      $user_agent = Session::uagent_no_version();
      Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
      $fields = ['session'=>$hash, 'user_agent'=>$user_agent, 'user_id'=>$id];
      $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$id, $user_agent]);
      $this->_db->insert('user_sessions', $fields);
      #dnd($id.'awd');
    }
  }

  public function logout(){
    $userSession = UserSessions::getFromCookie();
    if ($userSession) {
      #$userSession->delete();
      #$this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

    }
    Session::delete(CURRENT_USER_SESSION_NAME);
    if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
      Cookie::delete(REMEMBER_ME_COOKIE_NAME);
    }
    self::$currentLoggedInUser = null;
    return true;
  }

  public function registerNewUser($params){
    $this->assign($params);
    $this->deleted = 0;
    $this->LabourId = 'Lab' . ModelCommon::nextID($this->_table);
    $hash = md5(uniqid() + rand(0, 100));
    $this->VerificationKey = substr($hash,0,50);
    #dnd($this);
    $this->password = password_hash($this->password,PASSWORD_DEFAULT);  // thus must uncomment.
      #dnd($this->LabourId);
    $this->save();
  }

  public static function loginUserFromCookie(){
    $userSession = UserSessions::getFromCookie();
    $user_session_model = new UserSessions();
    $user_session = $user_session_model->findFirst([
      'conditions' => "user_agent = ? AND session = ?",
      'bind' => [Session::uagent_no_version(),Cookie::get(REMEMBER_ME_COOKIE_NAME)]
    ]);
    if ($userSession->user_id != '') {
      $user = new self($userSession->user_id);  //// $user = new self((int)$userSession->user_id);
      $user->login();
      return $user;
    }
    return false;
    }


  public static function currentLoggedInUser(){
    if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)){
        //echo(Session::get(CURRENT_USER_SESSION_NAME));
        $u = new Users(Session::get(CURRENT_USER_SESSION_NAME)); ///$u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
        //dnd($u);
        self::$currentLoggedInUser = $u;
    }
    return self::$currentLoggedInUser;
  }

  public function acls(){
    #dnd($this->acl);
    if (empty($this->acl)) return [];
    #return json_decode($this->acl, true);

    return $this->acl;
  }

  public function resetVeriKeyById($id=''){
      if($id!=''){
          if (substr($id,0,3)=='Lab'){
              $user = $this->findFirst(['conditions'=>'LabId = ?', 'bind'=>[$id]]);
              $user->resetVerificationKey();
          }
          else{
              $user = $this->findByUserName($id);
              $user->resetVerificationKey();
          }

          return(true);
      }
      return false;
  }


  public function resetVerificationKey(){
      $this->VerificationKey=0;
      $this->save();
  }

  public function get_img_path(){
      $user_id = currentUser()->LabourId;
      $user_img_path = ModelCommon::selectAllArray('Labourdetails','LabourId',$user_id)['img_path'];
      return($user_img_path);
  }
}
