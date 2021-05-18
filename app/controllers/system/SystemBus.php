<?php


class SystemBus extends System
{
    private  $BusMSModel;
    private  $BusMEModel;

    public function __construct($name=''){
        parent::__construct("Bus");
        $this->BusMSModel = ModelCommon::loading_model('BusMS');
        $this->BusMEModel = ModelCommon::loading_model('BusME');
    }


    public function get($state = 'everything'){
        // return all busses on given  @devin
        #echo($state);
        #echo('<br>');
        #echo('did i break php');
        #dnd($state == '' && $state == 0);
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            #echo('is int');
            return $this->BusMSModel->selectAll('BusState',$state);
        }
        elseif ($state == 'everything'){
            #echo('is string');
            return $this->BusMSModel->selectAllWithDelete('deleted',0);
        }
        return false;
    }

    public function updateState($id,$state){
        $unique=['BusNumber'=>$id];
        $params = ['BusState'=>$state];
        return $this->BusMSModel->UpdateRow($unique,$params);
    }

    public function check($id){
        if($this->BusMSModel->isBusNumberValid($id)){
            $ServicesGranted = $this->BusMEModel->populatechecklist($id);
            $bus =
                $this->BusMEModel->findByBusNumber($id);
            $AvailableServices = [];

            foreach ($ServicesGranted as $service=>$value){
                if (isset($bus->{$service}) && $bus->{$service}>=$value){
                    array_push($AvailableServices,$service);
                }
            }

            return $AvailableServices;
        }
        return false;
    }

    public function update_distance($busnumber,$mileage){
        return $this->BusMEModel->UpdateDistanceOfBus($busnumber,$mileage);
    }
}