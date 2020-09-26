<?php
namespace App\Repositories;

use App\Models\Shipment;

class ShipmentRepositories {
    
    public static function GetAll(){
        
        $models = Shipment::orderBy('id', 'desc')->get()->toArray();
        return $models;
        
    }
    
    public static function GetOne($id){
        $model = Shipment::find($id)->toArray();
        return $model;
    }
            
}
