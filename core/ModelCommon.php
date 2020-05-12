<?php

class ModelCommon{

  public static function  find($table,$params = []){
    $db= DB::getInstance();
    $results = [];
    $resultsQuery = $db->findArray($table, $params);
    /*
    foreach ($resultsQuery as $result) {


      foreach($result as $key=>$value){
        echo($value);
        echo('<br>');
      }



    }
    */
    return $resultsQuery;
  }

  public static function getColumnNames($table){
    $db= DB::getInstance();
    $db->getColumnNames($table);
    $rows = $db->results();
    $values=[];
    foreach($rows as $row){
      array_push($values,$row['COLUMN_NAME']);
    }
    return($values);
  }

  public static function ObjectTOArray($obj){
    $array = json_decode(json_encode($object), true);
    return($array);
  }
}
