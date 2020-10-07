<?php

class ModelCommon{

  public static function  find($table,$params = []){
    $db= DB::getMultitance();
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

  public static function insert($table, $fields){
      $db=DB::getMultitance();
      return ($db->insert($table,$fields));
  }

  public static function getColumnNames($table){
    $db= DB::getMultitance();
    $db->getColumnNames($table);
    $rows = $db->results();
    $values=[];
    foreach($rows as $row){
      array_push($values,$row['COLUMN_NAME']);
    }
    return($values);
  }

  public static function addColumn($table,$column_name,$data_type,$default = null){
      $db = DB::getMultitance();
      #dnd($db);
      $db->addColumn($table,$column_name,$data_type,$default);
  }

  public static function UpdateRow($table, $unique, $fields){
      $db = DB::getMultitance();
      return $db->updateRow($table, $unique, $fields);

  }

  public static function KeyExist($table, $unique=[]){
      $db= DB::getMultitance();
      if($unique != []){
          foreach ($unique as $key => $value){
              $statement=['conditions' => $key."= ?" , 'bind'=>[$value]];
              #dnd($key."= ?");
              $result = $db->find($table,$statement);
              //dnd($result);
              if (is_array($result) && !(empty($result))){
                  #dnd('trueeee');
                  return(true);
              }
          }
      }
      return (false);
}

  public static function validationID($table , $column ,$value){
      $db = DB::getMultitance();
      $params=['conditions'=> "{$column} = ?",'bind'=>[$value]];
      #print_r($params);
      #echo('<br>');
      #echo("{$column} = ?");
      #print_r($db->find($table,$params));
      if ($db->find($table,$params)){
          return(true);
      }
      return (false);
  }

  public static function loading_model( $model){
      if (class_exists($model)) {
          return (new $model());
      }
  }

  public static function nextID($table){
      $db= DB::getMultitance();
      $value = $db->numOfRows($table);
      #dnd($table);
      $count = $value[0]["COUNT(*)"];
      $count+=1;
      return "{$count}";
  }



  public static function ObjectTOArray($obj){
    if (is_object($obj)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $obj = get_object_vars($obj);
        #echo(implode('    |||',$obj));
    }

    if (is_array($obj)) {
        /*S
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        #echo(implode('    |||',$obj));
        return array_map(__FUNCTION__, $obj);
    } else {
        // Return array
        return $obj;
    }
  }

  public static function selectAllWithDelete($table,$column,$key){
      $db = DB::getMultitance();
      $results=[];
      if($db->selectAll($table,$column,$key)){
          //dnd($db->results());
          if($db->results()>0){
              foreach ($db->results() as $item){
                  $results[]=$item;
              }
              return $results;
          }
      }
      return(false);
  }

    public static function selectAllArrayWithDelete($table,$column,$key){
        $db = DB::getMultitance();
        $results=[];
        if($db->selectAllArray($table,$column,$key)){
            //dnd($db->results());
            if($db->results()>0){
                foreach ($db->results() as $item){
                    $results[]=$item;
                }
                return $results;
            }
        }
        return(false);
    }

    public static function selectAll($table,$column,$key,$filter=true , $single_lock = true){
        $results = ModelCommon::selectAllWithDelete($table,$column,$key);
        if($filter){
            $results = filter($results);
        }

        if($single_lock){
            if (count($results)==1){
                return($results[0]);
            }
        }
        return $results;

    }

    public static function selectAllArray($table,$column ='deleted',$key = 0,$filter=true, $single_lock = true){
        $results = ModelCommon::selectAllArrayWithDelete($table,$column,$key);
        if($filter){
            $results = filter($results);
        }

        if($single_lock){
            if (count($results)==1){
                return($results[0]);
            }
        }
        return $results;
    }

}
