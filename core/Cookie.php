<?php

class Cookie {

  public static function set($name, $value, $expiry){
    if(setCookie($name, $value, time()+$expiry)){
      return true;
    }
    return false;

  }

  public static function delete($name){
      if(self::exists($name)){
          self::set($name, '', time()-3600);
      }
  }

  public static function get($name){
    return $_COOKIE[$name];
  }

  public static function exists($name){
    return isset($_COOKIE[$name]);
  }

  public static function setList($name_list,$value_list){
      foreach ($name_list as $name){
          self::delete($name);
      }
      $i = 0;
      while ($i<sizeof($name_list)){

          self::set($name_list[$i],$value_list[$i],100);
          #dnd($value_list[$i]);
          $i+=1;
      }
  }
}
