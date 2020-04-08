<?php

  class Application{

    public function __construct(){
      $this->_set_reporting();
      $this->_unregister_global();
    }

    private function _set_reporting(){
      if(DEBUG){
        error_reporting(E_ALL);
        ini_set('display_errors',1);
      }else{
        error_reporting(E_ALL);
        ini_set('display_errors',0);
        ini_set('log_errors',1);
        ini_set('error_log'.ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
      }
    }

    private function _unregister_global(){
        if(ini_get('register_globals')){
          $globalsAry = ['_SESSION','_COOKIE','_POST','_GET','REQUEST', '_SERVER', '_ENV', '_FILES'];
          foreach ($globalsAry as $g) {
            foreach ($GOBALS[$G] as $key => $value) {
              if($GLOBALS[$key] == $value){
                unset($GLOBALS[$key]);
              }
            }
          }
        }
     }

  }
