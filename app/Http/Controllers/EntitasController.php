<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class EntitasController extends Controller
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
            $query = DB::table("tb_entitas")->orderBy("id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("entitas.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("entitas.tambah");
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "nama"  => "required",
            "jenis"  => "required",
            
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
            $data['nama'] = $request->nama;
            $data['jenis'] = $request->jenis;
            $data['deskripsi'] = $request->deskripsi;
            $data['created_at'] = Carbon::now();
            DB::table("tb_entitas")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Entitas berhasil disimpan."], 200);
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
        $data = DB::table("tb_entitas")->where("id",$id)->first();
        return view("entitas.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "nama"  => "required",
            "jenis"  => "required",
            
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
            $data['nama'] = $request->nama;
            $data['jenis'] = $request->jenis;
            $data['deskripsi'] = $request->deskripsi;
            $data['updated_at'] = Carbon::now();
            DB::table("tb_entitas")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Entitas berhasil disupdate."], 200);
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
            DB::table("tb_entitas")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Entitas berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
