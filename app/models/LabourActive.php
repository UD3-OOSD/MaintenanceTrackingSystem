<?php

class LabourActive extends Model{
    public function __construct($labour = ''){
        $table = 'labourdetails';
        parent::__construct($table,'LabourActive');

        if ($labour != '') {
            if (substr($labour,0,3)=='Lab') {
                $l = $this->_db->findFirst('labourdetails', ['conditions' => 'LabourId = ?', 'bind' => [$labour]]);
            }else{
                $l = $this->_db->findFirst('labourdetails', ['conditions'=>'nic = ?', 'bind'=>[$labour]]);
            }
            if ($l) {
                print_r($l);
                echo('<br>');
                echo('<br>');
                foreach ($l as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function findByLabourId($LabourId){
        return $this->findFirst(['conditions'=>'LabourId = ?', 'bind'=>[$LabourId]]);
    }

    public function findByNIC($nic){
        return $this->findFirst(['conditions'=>'nic = ?', 'bind'=>[$nic]]);
    }


    public function  isLabourNICValid($id){
        //dnd($id);
        $params=$this->createunique($id);
        //dnd($params);
        return $this->isValidKey($params);
    }

    public function registerNewLabouror($params){
        $this->assign($params);
        $this->deleted=0;
        $this->LabourId = 'Lab' . ModelCommon::nextID($this->_table);
        #dnd($this);
        $this->LabourState =0;
        $this->save();

    }

    public function stateChange_this($state){
        return $this->stateChange($this->LabourId,$state);
    }

    public function stateChange($id,$state){
        if(isset($state) && $this->createunique($id)){
            $unique=$this->createunique($id);
            return $this->UpdateRow($unique,['LabourState'=>$state]);
        }
        return(false);
    }

    public function edit($id,$params){
        $unique = $this->createunique($id);
        return $this->UpdateRow($unique,$params);
    }

    public function edit_this($params){
        return $this->edit($this->LabourId,$params);
    }

    public function createunique($id){
        if(isset($id)){
            if(substr($id,0,3)=='Lab'){
                $unique=['LabourId'=>$id];
            }else{
                $unique=['nic'=>$id];
            }

            return($unique);
        }
        return false;
    }
}