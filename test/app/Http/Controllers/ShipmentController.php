<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ShipmentRepositories;
use App\Models\Shipment;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'shipments' => ShipmentRepositories::GetAll(),
        ]);
    }
    
    public function indexWeb(){
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipment = new Shipment();
        $shipment->name = $request->input('name');
        $shipment->save();
        return response()->json([
            'shipment' => $shipment
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
        return response()->json([
            'shipments' => ShipmentRepositories::GetOne($id),
        ]);
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
        $shipment = Shipment::find($id);
        if($shipment !== null){
            $shipment->name = $request->input('name');
            $shipment->save();
            return response()->json([
                'shipment' => $shipment,
            ]);
        }else{
            return response()->json([
                'error_msg' => 'not found',
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
        $shipment = Shipment::find($id);
        if($shipment !== null){
            $shipment->delete();
            return response()->json([
                'success_msg' => 'Shipment destroyed',
            ]);
        }else{
            return response()->json([
                'error_msg' => 'not found',
            ]);
        }
    }
    
    
    /**
     * Sends parcel data to mail
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(){
        return response()->json([
            'success_msg' => 'OK',
        ]);   
    }
}
