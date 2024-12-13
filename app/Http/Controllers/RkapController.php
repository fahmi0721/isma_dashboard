<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Carbon\Carbon;
use DataTables;
use Validator;
class RkapController extends Controller
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
            $query = DB::table("tb_rkap")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("rkap.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view("rkap.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "tahun"  => "required",
            "pendapatan"  => "required",
            "biaya"  => "required",
            "laba_rugi"  => "required",
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
            
            $data['tahun'] = $request->tahun;
            $data['pendapatan'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->pendapatan);
            $data['biaya'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->biaya);
            $data['laba_rugi'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->laba_rugi);
            $data['created_at'] = Carbon::now();
            DB::table("tb_rkap")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data RKAP berhasil disimpan."], 200);
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
        $data = DB::table("tb_rkap")->where("id",$id)->first();
        return view("rkap.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "tahun"  => "required",
            "pendapatan"  => "required",
            "biaya"  => "required",
            "laba_rugi"  => "required",
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
            $data['tahun'] = $request->tahun;
            $data['pendapatan'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->pendapatan);
            $data['biaya'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->biaya);
            $data['laba_rugi'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->laba_rugi);
            $data['updated_at'] = Carbon::now();
            DB::table("tb_rkap")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data RKAP berhasil diupdate."], 200);
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
            DB::table("tb_rkap")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data RKAP berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
