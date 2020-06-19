<?php

  class Router{

      private static $user;
      private static $user_name = '';


    public static function route($url){
      //controller
      $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
      $controller_name = $controller;
      array_shift($url);


      //action
      $action = (isset($url[0]) && $url[0] != '') ? $url[0].'Action' : 'indexAction';
      $action_name = (isset($url[0]) && $url[0] != '')? $url[0] : 'index';
      array_shift($url);

      //acl check
        #dnd($controller_name);
      $grantAccess = self::hasAccess($controller_name, $action_name);
      #echo($grantAccess);
      #echo("   Router");
      #echo('<br>');
      #$grantAccess=true;
      if (!$grantAccess) {
        $controller_name = $controller = ACCESS_RESTRICTED;
        $action = 'indexAction';
      }


      //params
      $queryParams = $url;

      if (Router::$user_name != $controller_name) {
          //echo($controller_name);
          $dispatch = new $controller($controller_name, $action);
          Router::$user_name = $controller_name;
          Router::$user = $dispatch;
      }else{
          $dispatch = Router::$user;
      }

      if(method_exists($controller, $action)){
        call_user_func_array([$dispatch, $action], $queryParams);
      }else{
        die('That method doesnt exists in the controlles->'.$controller.'.php');
      }

      #echo $controller.'<br>';
      #echo $action.'<br>';
      #dnd($url);
    }

    public static function redirect($location){
      #dnd($location);
      if(!headers_sent()){
        header('Location: '.PROOT.$location);
      }else{
        echo '<script type="text/javascript">';
        echo 'window.location.href'.PROOT.$location.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv=>"refresh" content="0;url='.$location.'"/>';
        echo '</noscript>';exit;
      }
     }

      public static function hasAccess($controller_name, $action_name='index'){

        $acl_file = file_get_contents(ROOT.DS.'app'.DS.'acl.json');
        $acl = json_decode($acl_file, true);
        #dnd($acl);
        $current_user_acls = ["Guest"];
        $grantAccess = false;

        if (Session::exists(CURRENT_USER_SESSION_NAME)) {
          $current_user_acls[] = "LoggedIn";
          $lis = currentUser()->acls();
            #dnd(currentUser());
          #dnd($lis);
          $current_user_acls[] = $lis;
          #foreach ($lis as $a) {
          #  $current_user_acls[] = $a;
          #}
        }


        #dnd(".................");

        foreach ($current_user_acls as $level) {

          if(array_key_exists($level,$acl) && array_key_exists($controller_name, $acl[$level])){
            if(in_array($action_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])){
              $grantAccess = true;
              break;
            }
          }
        }

        foreach ($current_user_acls as $level) {
          $denied = $acl[$level]['denied'];
          if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])){
            $grantAccess = false;
            break;
          }

        }

        #echo($grantAccess);
        #echo("   hasAccess");
        #echo('<br>');
        return $grantAccess;
         //dnd($current_user_acls);
      }

      public static function getMenu($menu){
        $menuAry = [];
        $menuFile = file_get_contents(ROOT.DS.'app'.DS.$menu.'.json');
        $acl = json_decode($menuFile, true);
        foreach ($acl as $key => $val) {
          if(is_array($val)){
            $sub = [];
            foreach ($val as $k => $v) {
              if($k == 'separator' && !empty($sub)){
                $sub[$k] = '';
                continue;
              }else if($finalVal = self::get_link($v)){
                $sub[$k] = $finalVal;
              }
            }
            if(!empty($sub)){
              $menuAry[$key] = $sub;
            }
          }else {
            if($finalVal = self::get_link($val)){
              $menuAry[$key] = $finalVal;
            }
          }
        }
        #die();
        #print_r($menuAry);
        return $menuAry;
      }

      private static function get_link($val){
        //check if it is external links
        if(preg_match('/https?:\/\//', $val) == 1){
          return $val;
        }else{
          $uAry = explode('/', $val);
          $controller_name = ucwords($uAry[0]);
          $action_name = (isset($uAry[1]))? $uAry[1] : '';
          #echo $action_name. " ".self::hasAccess($controller_name, $action_name)." -----<br>";
          if(self::hasAccess($controller_name, $action_name)){
            return PROOT.$val;
          }
          return false;
        }
      }

}
