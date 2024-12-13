<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = DB::table("tb_periode")->orderBy("id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("periode.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("periode.tambah");
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "periode"  => "required",
            "keterangan"  => "required",
            
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }
        DB::beginTransaction();
        try {
            DB::table("tb_periode")->update(["status" => "0"]);
            $data['nama'] = $request->periode;
            $data['keterangan'] = $request->keterangan;
            $data['status'] = "1";
            $data['created_at'] = Carbon::now();
            DB::table("tb_periode")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data periode berhasil disimpan."], 201);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
        
    }

    /**
     * Status update status resource in storage.
     */
    public function status(Request $request)
    {
        $validates 	= [
            "id"  => "required",
            "status"  => "required",
            
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }
        $status = $request->status == "0" ? "1" : "0";
        DB::beginTransaction();
        try {
            $cek_periode_aktif = DB::table("tb_periode")->where("status","1")->count();
            if(($cek_periode_aktif == 1) && $status == "1"){
                return response()->json(['status'=>'error', 'messages'=>"Terdapat periode yang masih open, close terlebih dahulu."], 201);
                // exit();
            }else{
                $data['status'] = $status;
                $data['updated_at'] = Carbon::now();
                DB::table("tb_periode")->where("id",$request->id)->update($data);
                DB::commit();
                return response()->json(['status'=>'success', 'messages'=>"Status periode berhasil diupdate."], 200);
            }
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = DB::table("tb_periode")->where("id",$id)->first();
        return view("periode.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "periode"  => "required",
            "keterangan"  => "required",
            
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }
        DB::beginTransaction();
        try {
            $data['nama'] = $request->periode;
            $data['keterangan'] = $request->keterangan;
            $data['updated_at'] = Carbon::now();
            DB::table("tb_periode")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Periode berhasil disimpan."], 201);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            DB::table("tb_periode")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Periode berhasil dihapus."], 201);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
