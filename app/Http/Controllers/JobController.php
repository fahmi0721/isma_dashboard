<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class JobController extends Controller
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
            $query = DB::table("tb_jabatan")
                    ->select("tb_jabatan.*",DB::raw("tb_tipe_jabatan.nama as job_type"))
                    ->join("tb_tipe_jabatan","tb_tipe_jabatan.id","=","tb_jabatan.job_type_id")
                    ->orderBy("tb_jabatan.id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("job.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['job_type'] = DB::table("tb_tipe_jabatan")->select("id","nama")->get();
        return view("job.tambah",compact("data"));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "nama"  => "required",
            "tipe_jabatan"  => "required",
            "deskripsi"  => "required",
            
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
            $data['job_type_id'] = $request->tipe_jabatan;
            $data['deskripsi'] = $request->deskripsi;
            $data['created_at'] = Carbon::now();
            DB::table("tb_jabatan")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jabatan berhasil disimpan."], 200);
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
        $data['jabatan'] = DB::table("tb_jabatan")->where("id",$id)->first();
        $data['job_type'] = DB::table("tb_tipe_jabatan")->select("id","nama")->get();
        return view("job.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "nama"  => "required",
            "tipe_jabatan"  => "required",
            "deskripsi"  => "required",
            
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
            $data['job_type_id'] = $request->tipe_jabatan;
            $data['deskripsi'] = $request->deskripsi;
            $data['updated_at'] = Carbon::now();
            DB::table("tb_jabatan")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jabatan berhasil diupdate."], 200);
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
            DB::table("tb_jabatan")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jabatan berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
