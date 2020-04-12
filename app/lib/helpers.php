<?php

function dnd($data){
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}

function sanitize($dirty){
  echo "123";
  return htmlentities($dirty, ENT_QUOTES, 'utf-8');;
}

function currentUser(){
  return Users::$currentLoggedInUser();
}
