<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class ProjectController extends Controller
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
            $query = DB::table("tb_project")
                    ->select("tb_project.*",DB::raw("tb_entitas.nama as entitas"),DB::raw("tb_kategori_project.nama as kategori"),DB::raw("CONCAT(DATE_FORMAT(valid_from, '%d %M %Y'),' s.d ', DATE_FORMAT(valid_to, '%d %M %Y')) as valid"))
                    ->join("tb_entitas","tb_entitas.id","=","tb_project.entitas_id")
                    ->join("tb_kategori_project","tb_kategori_project.id","=","tb_project.kategori_id")
                    ->orderBy("tb_project.id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("project.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['entitas'] = DB::table("tb_entitas")->select("id","nama")->get();
        $data['kategori_project'] = DB::table("tb_kategori_project")->select("id","nama")->get();
        return view("project.tambah",compact("data"));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "kode_project"  => "required",
            "nama"  => "required",
            "entitas"  => "required",
            "kategori_project"  => "required",
            "deskripsi"  => "required",
            "valid_from"  => "required",
            "valid_to"  => "required",
            
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
            $data['kode'] = $request->kode_project;
            $data['nama'] = $request->nama;
            $data['entitas_id'] = $request->entitas;
            $data['kategori_id'] = $request->kategori_project;
            $data['deskripsi'] = $request->deskripsi;
            $data['valid_from'] = $request->valid_from;
            $data['valid_to'] = $request->valid_to;
            $data['created_at'] = Carbon::now();
            DB::table("tb_project")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Project berhasil disimpan."], 200);
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
        $data['project'] = DB::table("tb_project")->where("id",$id)->first();
        $data['entitas'] = DB::table("tb_entitas")->select("id","nama")->get();
        $data['kategori_project'] = DB::table("tb_kategori_project")->select("id","nama")->get();
        return view("project.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "kode_project"  => "required",
            "nama"  => "required",
            "entitas"  => "required",
            "kategori_project"  => "required",
            "deskripsi"  => "required",
            "valid_from"  => "required",
            "valid_to"  => "required",
            
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
            $data['kode'] = $request->kode_project;
            $data['nama'] = $request->nama;
            $data['entitas_id'] = $request->entitas;
            $data['kategori_id'] = $request->kategori_project;
            $data['deskripsi'] = $request->deskripsi;
            $data['valid_from'] = $request->valid_from;
            $data['valid_to'] = $request->valid_to;
            $data['updated_at'] = Carbon::now();
            DB::table("tb_project")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Project berhasil diupdate."], 200);
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
            DB::table("tb_project")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Project berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
