<?php


class SystemBus implements System
{
    private static $bystembus = NULL;
    private static $BusMSModel;
    private static $BusMEModel;

    private function __construct(){
        SystemBus::$BusMSModel = ModelCommon::loading_model('BusMS');
        SystemBus::$BusMEModel = ModelCommon::loading_model('BusME');
    }

    public static function getInstance(){
        if(!isset(SystemBus::$bystembus)){
            SystemBus::$bystembus = new SystemBus();
        }
        return SystemBus::$bystembus;
    }
    public function get($state = ''){
        // return all busses on given  @devin
        if (is_int($state)){
            #return ModelCommon::selectAllArray('bustable','BusState',$state);
            return SystemBus::$BusMSModel->selectAll('BusState',$state);
        }
        return false;
    }

    public function updateState($id,$state){
        $unique=['BusNumber'=>$id];
        $params = ['BusState'=>$state];
        return SystemBus::$BusMSModel->UpdateRow($unique,$params);
    }

    public function check($id){
        if(SystemBus::$BusMSModel->isBusNumberValid($id)){
            $ServicesGranted = SystemBus::$BusMEModel->populatechecklist($id);
            $bus = SystemBus::$BusMEModel->findByBusNumber($id);
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
}