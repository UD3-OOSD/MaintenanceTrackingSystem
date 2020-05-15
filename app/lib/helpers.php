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
  return Users::currentLoggedInUser();
}

function posted_values($post){
  $clean_array = [];
  foreach ($post as $key => $value) {
    $clean_array[$key] = sanitize($value);
  }
  return $clean_array;
}

function mergeData($data,$additional){
    return array_merge($additional,$data);
}

function currentPage(){
  $currentPage = $_SERVER['REQUEST_URI'];
  if($currentPage == PROOT || $currentPage == PROOT.'home/index'){
    $currentPage = PROOT.'home';
  }
  return $currentPage;
}

function displayplaintable($heads,$list){
  $html = '<table id="t1" class="content-table">';
    $html.='<thead>';
      $html.='<tr>';
      foreach ($heads as $head) {
        $html.= '<th>'.$head.'</th>';
      };
      $html.='</tr>';
    $html.='</thead>';
    $html.='<tbody>';
    foreach ($list as $k){
        $html.='<tr>';
        foreach ($k as $val) {
          $html.='<td>'.$val.'</td>';
        }
        $html.='</tr>';
    }
    $html.='</tbody>';
  $html.='</table>';

  return $html;
}

function displaylinkedtable($heads,$list,$links){
  $html = '<table id="t1" class="content-table">';
    $html.='<thead>';
      $html.='<tr>';
      foreach ($heads as $head) {
        $html.= '<th>'.$head.'</th>';
      };
      $html.='</tr>';
    $html.='</thead>';
    $html.='<tbody>';
    foreach ($list as $ind=> $k){
        $html.='<tr>';
        foreach ($k as $val) {
          $html.='<td><a href = '.$links[$ind].'>'.$val.'</a></td>';
        }
        $html.='</tr>';
    }
    $html.='</tbody>';
  $html.='</table>';

  return $html;
}
