<?php
#the bus model
class BusME extends Model{
  public $GrantedService ;

  public function __construct($bus=''){
    $this->GrantedService = null ;
    $table='busmileage';
    $this->idtype = 'BusNumber';
    parent::__construct($table,'BusME');

    if ($bus != '') {
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);

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

  public function populatechecklist(){
      //dnd($id);
    $tables=['bustable','buscategory'];
    $keys = ['BusCategory','BusType'];
    $params = ['bustable.BusId','buscategory.*'];
    $id = ['BusId'=> $this->findIDbyBusNumber($this->BusNumber)];

    //dnd($id);
    $result=$this->LeftJoinSpecific($tables,$keys,$params,$id,$unique=true);
    #dnd('here');
    #dnd($result);
    unset($result['BusId']);
    unset($result['BusType']);
    $filtered=[];
    foreach ($result as $service => $value){
        if ($value!=null){
            $filtered[$service]=$value;
        }
    }
    //dnd($filtered);
    $this->GrantedService = $filtered;
    return $filtered;
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
      #dnd($this->isValidKey($params));
      return $this->isValidKey($params);
  }


  public function DistanceUpdate($params){
      $this->assign($params);
      $this->save();
  }

  public function findIDbyBusNumber($BusNumber){
      if(!array_key_exists('FindBusIdFromBusNumberCommunication',$this->CommandMap)){
          $this->addCommandToMap(['FindBusIdFromBusNumberCommunication'=>new FindBusIdFromBusNumberCommunication()]);
      }

      if ($this->CommandMap['FindBusIdFromBusNumberCommunication']->setDetails(['BusNumber'=>$BusNumber])->communicate($this)){
          return ($this->Communication_result);
      }
      //return (ModelCommon::selectAllArray('bustable','BusNumber',$BusNumber)['BusId']);
  }


  public function UpdateTotalDistance($distance){
      $this->TotalDistanceTravelled=$this->TotalDistanceTravelled+$distance;
  }

  public function LogDistance($key,$distance){ #can be used to make zero
          $this->{$key}=$distance;
  }

  public function IncrementDistance($key,$distance){
      if (isset($this->{$key})){
          $value = $this->{$key}+$distance;
          $this->LogDistance($key,$value);
      }else{
          $this->LogDistance($key,$distance);
      }
  }

  public function UpdateDistanceOfBus($id,$distance){
      //dnd('comes');
      $bus = $this->findByBusNumber($id);
      if ($bus && isset($bus->deleted) && $bus->deleted==0){
          $bus->populatechecklist();
          $bus->DistanceIncrement($distance);
          return true;
      }
      return false;
  }

  public function DistanceIncrement($distance){
      if (!($this->GrantedService == null) && isset($distance)){
          foreach ($this->GrantedService as $key => $value){
              #print_r($this->GrantedService);
            $this->IncrementDistance($key,$distance);
          }
          #dnd('is there any errore');
          $this->UpdateTotalDistance($distance);
          $this->save();
          return true;
      }
      return false;
  }

  public function CheckForService(){
      $AvailableServices = [];
      foreach ($this->GrantedService as $service=>$value){
          if (isset($bus->{$service}) && $bus->{$service}>=$value){
              array_push($AvailableServices,$service);
          }
      }
      return $AvailableServices;
  }


  public function check($id){
      $bus = $this->findByBusNumber($id);
      $bus->populatechecklist();
      return $bus->CheckForService();
  }
}


