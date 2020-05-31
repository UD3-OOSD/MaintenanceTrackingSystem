<?php
#the bus model
class BusMS extends Model{
  private $idtype;

  public function __construct($bus=''){
    $table='bustable';
    $this->idtype = 'BusId';
    parent::__construct($table);
    if ($bus != '') {
      if (is_int($bus)) {
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
    $this->assign($params);
    $this->deleted=0;
      $this->save($this->idtype);
  }

  public function editEntry($params){
      $this->assign($params);
      $this->save($this->idtype);
  }

    public function  isBusNumberValid($id){
        $params=['BusNumber'=>$id];
        return $this->isValidKey($params);
    }

    public function edit($id,$params){
        return $this->UpdateRow(['BusId'=>$id],$params);
    }

    public function edit_this($params){
        return $this->edit(['BusId'=>$this->BusId],$params);
    }

    public function  isBusIdValid($id){
        $params=['BusId'=>$id];
        return $this->isValidKey($params);
    }

    public function stateChange_this($state){
        return $this->stateChange($this->BusId,$state);
    }

    public function stateChange($id,$state){
        if(isset($id)&&isset($state)){
            if(is_int($id)){
                $unique=['BusId'=>$id];
            }else{
                $unique=['BusNumber'=>$id];
            }

           return $this->UpdateRow($unique,$state);
        }
    }

}
