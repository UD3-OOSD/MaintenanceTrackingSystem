<?php


  define('DS', DIRECTORY_SEPARATOR);
  define('ROOT', dirname(__FILE__));

  // load configuration and helper ReflectionFunctionAbstract
    require_once(ROOT.DS.'config'.DS.'config.php');
    require_once(ROOT.DS.'app'.DS.'lib'.DS.'helpers'.DS.'functions.php');

    //Autoload classes
    function autoload($classname){
      if(file_exists(ROOT.DS.'core'.DS.$classname.'.php')){
        require_once(ROOT.DS.'core'.DS.$classname.'.php');
      }elseif(file_exists(ROOT.DS.'app'.DS.'controllers'.DS.$classname.'.php')){
        require_once(ROOT.DS.'app'.DS.'controllers'.DS.$classname.'.php');
      }elseif (file_exists(ROOT.DS.'app'.DS.'controllers'.DS.'bus'.DS.$classname.'.php')) {
        require_once(ROOT.DS.'app'.DS.'controllers'.DS.'bus'.DS.$classname.'.php');
      }elseif(file_exists(ROOT.DS.'app'.DS.'controllers'.DS.'labour'.DS.$classname.'.php')){
        require_once(ROOT.DS.'app'.DS.'controllers'.DS.'labour'.DS.$classname.'.php');
      }elseif (file_exists(ROOT.DS.'app'.DS.'controllers'.DS.'service'.DS.$classname.'.php')) {
        require_once(ROOT.DS.'app'.DS.'controllers'.DS.'service'.DS.$classname.'.php');
      }elseif (file_exists(ROOT.DS.'app'.DS.'controllers'.DS.'system'.DS.$classname.'.php')) {
          require_once(ROOT.DS.'app'.DS.'controllers'.DS.'system'.DS.$classname.'.php');
      }elseif(file_exists(ROOT.DS.'app'.DS.'models'.DS.$classname.'.php')){
        require_once(ROOT.DS.'app'.DS.'models'.DS.$classname.'.php');
      }elseif(file_exists(ROOT.DS.'app'.DS.'models'.DS.'communication'.DS.$classname.'.php')){
          require_once(ROOT.DS.'app'.DS.'models'.DS.'communication'.DS.$classname.'.php');
      }
    }

  spl_autoload_register('autoload');
  session_start();

  #echo $_SERVER['PATH_INFO'];
  $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
  #dnd($_SERVER['PATH_INFO']);
  #var_dump($url);
  #$db = DB::getInstance();
  #dnd($db);
  if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    Users::loginUserFromCookie();
  }
  // Route the request
  Router::route($url);
