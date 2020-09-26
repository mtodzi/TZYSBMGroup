<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Repositories\ItemRepositories;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shipment_id)
    {
        return response()->json([
            'item' => ItemRepositories::GetAll($shipment_id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->input('name');
        $item->code = $request->input('code');
        $item->shipment_id = $request->input('shipment_id');
        $item->save();
        return response()->json([
            'item' => $item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ItemRepositories::GetOne($id);
        if($item){
            return response()->json([
                'item' => ItemRepositories::GetOne($id),
            ]);
        }else{
            return response()->json([
                'error_msg' => 'not found item',
            ]);
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if($item !== null){
            $item->name = $request->input('name');
            $item->code = $request->input('code');
            $item->shipment_id = $request->input('shipment_id');
            $item->save();
            return response()->json([
                'item' => $item
            ]);
        }else{
            return response()->json([
                'error_msg' => 'not found item',
            ]);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item !== null){            
            $item->delete();
            return response()->json([
                'success_msg' => 'Item destroyed'
            ]);
        }else{
            return response()->json([
                'error_msg' => 'not found item',
            ]);
        }
    }
}
