<?php

class LabourActive extends Model{
    private $idtype;
    public function __construct($labour = ''){

        $table = 'labourdetails';
        $this->idtype = 'LabourId';
        parent::__construct($table,'LabourActive');

        if ($labour != '') {
            if (substr($labour,0,3)=='Lab') {
                $l = $this->_db->findFirst('labourdetails', ['conditions' => 'LabourId = ?', 'bind' => [$labour]]);
            }
            if (isset($l)) {
                foreach ($l as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function isLabourIdValid($id){
        $params = ['LabourId'=>$id];
        return $this->isValidKey($params);
    }

    public function registerNewLabouror($params){
        $this->assign($params);
        $this->deleted=0;
        $this->LabourId = 'Lab' . ModelCommon::nextID($this->_table);
        #dnd($this);
        $this->LabourState =0;
        $this->save($this->idtype);

    }

    public function stateChange_this($state){
        return $this->stateChange($this->LabourId,$state);
    }

    public function stateChange($id,$state){
        if(isset($id)&&isset($state)){
            $unique=['LabourId'=>$id];
            return $this->UpdateRow($unique,['LabourState'=>$state]);
        }
        return(false);
    }

}