<?php

function dnd($data){
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}

function sanitize($dirty){
  #echo "123";
  return htmlentities($dirty, ENT_QUOTES, 'utf-8');;
}

function currentUser(){
  return Users::$currentLoggedInUser();
}

function posted_values($post){
  $clean_array = [];
  foreach ($post as $key => $value) {
    $clean_array[$key] = sanitize($value);
  }
  return $clean_array;
}
