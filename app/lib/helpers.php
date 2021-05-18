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


function sendMail($to,$header,$mass,$link=''){

   //$to = "xyz@somedomain.com";
   $subject = $header;

   $message = "<b>".$mass.".</b>";
   $message .= "<div style=\"background-color:#d7263d;text-align:center;color:#ffffff;border-radius:3px;width:180px;font-size:18px;text-decoration:none;font-weight:bold\">
   <a style=\"margin:0;padding:0px 3px 0px 3px;display:block;color:#ffffff;font-size:14px;line-height:16px;font-family:Arial,Helvetica,sans-serif;text-align:center;font-weight:bold;text-align:center;text-decoration:none;border:12px solid #d7263d;border-radius:3px\" target=\"_blank\" href = ".$link." >Verify</a></div>";
   //$massage = "<b> is message</b>";
   //$massage .= "<a href = ".$link." >Verify</a>";

   $header = "From:abc@somedomain.com \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";

   $retval = mail ($to,$subject,$message,$header);

   if( $retval == true ) {
      echo "Message sent successfully...";
      return true;
   }else {
      echo "Message could not be sent...";
      return false;
   }

function validationID($table , $column , $value ,$tag){

    $html = '<ul class="id_danger">';
    if (ID_isvalid($table, $column, $value)) {
        $html .= '<li class="text-danger">' . "The {$value} is not in {$column} in table {$table}" . '</li>';
        $html .= '<script>jQuery{"document"}.ready(function(){jQuery("#' . $tag . '").parent().closest("div").addClass("has-error");});</script>';
    } else {
        $html .= '<li class="text-danger">' . "yayyyyy" . '</li>';
    }
    $html .= '</ul>';
    return $html;


    }

}

function ID_isvalid($table, $column, $value){
    $model = ModelCommon::loading_model($table);
    return $model->isValidKey([$column=>$value]);
}

function validationID($table , $column , $value ,$tag){

   $html = '<ul class="id_danger">';
   if(ID_isvalid($table , $column , $value)){
       $html .= '<li class="text-danger">'."The {$value} is not in {$column} in table {$table}".'</li>';
       $html .= '<script>jQuery{"document"}.ready(function(){jQuery("#'.$tag.'").parent().closest("div").addClass("has-error");});</script>';
   }else{
       $html .= '<li class="text-danger">'."yayyyyy".'</li>';
   }
   $html .= '</ul>';
   return $html;
}

function ObjecttoArray($object){
    $array=[];
    foreach ($object as $key=>$value)
        $array[$key] = $value;
    return $array;
}

function filter($collection){
    //dnd($collection);
    $filtered=[];
    if (!isset($collection) || $collection==[]){
        return $filtered;
    }
    if(is_array($collection)){
        if(is_array($collection[0])){
            foreach ($collection as $item) {
                if (isset($item['deleted']) && $item['deleted']==0){
                    $filtered[] = $item;
                }
            }
        }

        if(is_object($collection[0])){
            foreach ($collection as $item) {
                if (isset($item->deleted) && $item->deleted==0){
                    $filtered[] = $item;
                }
            }
        }
    }else{
        if(is_array($collection)){
            foreach ($collection as $item) {
                if (isset($item['deleted']) && $item['deleted']==0){
                    $filtered[] = $item;
                }
            }
        }

        if(is_object($collection)){
            foreach ($collection as $item) {
                if (isset($item->deleted) && $item->deleted==0){
                    $filtered[] = $item;
                }
            }
        }
    }
    #dnd($filtered);
    return $filtered;
}

function filter_attr($collection, $attrs){
    $res = [];
    foreach ($collection as $obj){
        $newobj = new stdClass();
        foreach ($attrs as $attr){
            $newobj->$attr = $obj->$attr;
        }
        $res[] = $newobj;
    }
    return $res;
}

function NicToId($id){
    #dnd($id);
    if (substr($id,0,3)=='Lab'){
        $column = 'LabourId';
        $other = 'nic';
    }else{
        $column = 'nic';
        $other = 'LabourId';
    }
    #dnd($id);
    $Labour = ModelCommon::loading_model('LabourActive',$specific = $id);
    #dnd('after');
    return $Labour->{$other};
    #return ModelCommon::selectAllArray('labourdetails',$column,$id)[$other];
}

function Nic2LabId($NIC){
    if ((substr($NIC,0,3)=='Lab')){
        return $NIC;
    }
    return NicToId($NIC);
}

function LabId2Nic($LabId){
    if (!(substr($LabId,0,3)=='Lab')){
        return $LabId;
    }

    return NicToId($LabId);
}

function BusNumber2Id($BusNumber){
    if(substr($BusNumber,0,3)=='Bus'){
        return($BusNumber);
    }

    $bus = ModelCommon::loading_model('bustable',$BusNumber);
    return $bus->BusId;
    #return ModelCommon::selectAllArray('bustable','BusNumber',$BusNumber)[0]['BusId'];
}

function listToString($list){
    return join(" ",$list);
}

function objToString($stdobj){
    return listToString(ObjecttoArray($stdobj));
}

function dataToString($data){
    return join(" ",array_map("objToString",$data));
}

function filterToObj($data,$heads){
    $stdObjs = [];
    foreach($data as $obj){
        $stdObj = new stdClass();
        foreach ($heads as $attr){
            $stdObj->$attr = $obj->$attr;
        }
    }
    return $stdObjs;
}

function filterToString($data,$heads){
    $stdObjs = "";
    #dnd(gettype($data));
    if(gettype($data) != "object") {
        foreach ($data as $obj) {
            #print_r($obj);
            //$stdObj = new stdClass();
            foreach ($heads as $attr) {
                #echo($attr);
                #echo('<br>');
                $stdObjs .= " " . join('-',explode(" ",$obj->$attr));
            }
        }
    }else{
        foreach ($heads as $attr) {
            #dnd($attr);
            $stdObjs .= " " . join('-',explode(" ",$data->$attr));
        }
    }
    #dnd($stdObjs);
    return trim($stdObjs," ");
}