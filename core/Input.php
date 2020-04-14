<?php

class Input{

  public static function sanitized($dirty){
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
  }

  public static function get($input){
    if(isset($_POST[$input])){
      #echo self::sanitize($input);
      return self::sanitize($input);
    }else if(isset($_GET[$input])){
      return self::santize($_GET[$input]);
    }
  }
}
