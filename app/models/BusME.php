<?php
#the bus model
class BusME extends Model{

  public function __construct($bus=''){

    $table='busmileage';
    parent::__construct($table,'BusME','BusNumber');

    if ($bus != '') {
      if (is_int($bus)) {
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusId = ?', 'bind'=>[$bus]]);
      }else{
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);
      }
      if ($b) {
        foreach ($b as $key => $value) {
          $this->$key = $value;
        }
      }
    }
  }

  public function findByBusNumber($BusNumber){
    return $this->findFirst(['conditions'=>'BusNumber = ?', 'bind'=>[$BusNumber]]);
  }

  public function populatechecklist($id){
      //dnd($id);
    $tables=['bustable','buscategory'];
    $keys = ['BusCategory','BusType'];
    $params = ['bustable.BusId','buscategory.*'];
    $id = ['BusId' => $id];
    //dnd($id);
    $result=$this->LeftJoinSpecific($tables,$keys,$params,$id);
    //dnd('here');
    unset($result['BusId']);
    unset($result['BusType']);
    $filtered=[];
    foreach ($result as $service => $value){
        if ($value!=null){
            $filtered[$service]=$value;
        }
    }
    //dnd($filtered);
    return($filtered);
  }

  public function NewBusDistanceUpdate($BusNumber,$Distance){
    #dnd($Distance);

    $columns = ModelCommon::getColumnNames($this->_table);
    $params=['BusNumber'=>$BusNumber];
    #echo(implode('    |||',$columns));
    #dnd('..............................');
    foreach($columns as $key){
      if($key!='BusNumber'){
        $params[$key] = $Distance;
      }
    }
    #echo(implode('    |||',$params));
    #dnd($params);

    $this->assign($params);
    $this->deleted = 0;
    $this->save();
  }

  public function updateRowByBusNumber($number,$params){
      if(isset($number)){
          $unique = ['BusNumber'=>$number];
          return $this->UpdateRow($unique,$params);
      }
  }

  public function  isBusNumberValid($id){
      #dnd($id);
      $params=['BusNumber'=>$id];
      return $this->isValidKey($params);
  }


  public function DistanceUpdate($params){
      $this->assign($params);
      $this->save();
  }

  public function findIDbyBusNumber($BusNumber){
      return (ModelCommon::selectAllArray('bustable','BusNumber',$BusNumber)['BusId']);
  }

  public function DistanceIncrement($checklist,$distance){
      if (!empty($checklist) && isset($distance)){
          foreach ($checklist as $key => $value){
            if (isset($this->{$key})){
                $this->{$key} = $this->{$key}+$distance;
            }else{
                $this->{$key}=$distance;
            }
          }
          $this->TotalDistaceTravelled=$this->TotalDistaceTravelled+$distance;
      }
  }
}


