<?php
namespace App\Repositories;

use App\Models\Item;

/**
 * Description of ItemRepositories
 *
 * @author mtodz
 */
class ItemRepositories {
    
    public static function GetAll($shipment_id){
        $items = Item::where(['shipment_id'=>$shipment_id])->get()->toArray();
        return $items;
    }
    
    public static function GetOne($id){
        $items = Item::find($id);
        if($items !== null){                        
            return $items->toArray();
        }else{
            return false;
        }    
    }
}
