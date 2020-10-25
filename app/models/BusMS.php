<?php
#the bus model
class BusMS extends Model{

  public function __construct($bus=''){
    $table='bustable';
    parent::__construct($table,'BusMS');
    if ($bus != '') {
      if (substr($bus,0,3)=='Bus') {
        $b = $this->_db->findFirst('bustable', ['conditions'=>'BusId = ?', 'bind'=>[$bus]]);
      }else{
        $b = $this->_db->findFirst('bustable', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);
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

  public function registerNewBus($params){
      #dnd($params);
    $this->assign($params);
    $this->deleted=0;
    #$this->BusId = 'Bus' . ModelCommon::nextID($this->_table);
    $this->BusId = 'Bus' . $this->nextID();
    $this->BusState = 0;
    $this->save();
  }


    public function  isBusNumberValid($id){
        $params=$this->createunique($id);
        return $this->isValidKey($params);
    }

    public function edit($id,$params){
        $unique = $this->createunique($id);
        return $this->UpdateRow($unique,$params);
    }

    public function edit_this($params){
        return $this->edit($this->BusNumber,$params);
    }

    public function createunique($id){
        if(isset($id)){
            if(substr($id,0,3)=='Bus'){
                $unique=['BusId'=>$id];
            }else{
                $unique=['BusNumber'=>$id];
            }

            return($unique);
        }
        return false;
    }

    public function stateChange($id,$state){
        if(isset($state) && $this->createunique($id)){
           return $this->UpdateRow($this->createunique(),$state);
        }
        return(false);
    }

}
