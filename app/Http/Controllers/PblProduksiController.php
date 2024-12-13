<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use DataTables;
use Validator;
class PblProduksiController extends Controller
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
            $query = DB::table("tb_pb_project")
                    ->select("tb_pb_project.*",DB::raw("tb_periode.nama as periode"),DB::raw("tb_project.nama as project"))
                    ->join("tb_periode","tb_periode.id","=","tb_pb_project.periode_id")
                    ->join("tb_project","tb_project.id","=","tb_pb_project.project_id")
                    ->orderBy("tb_pb_project.id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("pbl_project.index");
        }
    }

    private function get_periode(){
        $bulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember",
        );
        $periode = DB::table("tb_periode")->where("status","1")->first();
        $split = explode("-",$periode->nama);
        return $bulan[$split[1]] . " ". $split[0];
    }

    private function get_periode_id(){
        
        $periode = DB::table("tb_periode")->where("status","1")->first();
        return $periode->id;
    }

    private function cek_periode(){
        $dt = DB::table("tb_periode")->where("status","1")->count();
        return $dt;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if($this->cek_periode() > 0){
            $data['periode'] = $this->get_periode();
        }else{
            $data['periode'] = "Periode belum aktif";
        }
        $periode = $this->cek_periode();
        $project = DB::table("tb_project")->get();
        return view("pbl_project.tambah",compact("periode","data","project"));
    }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "project"  => "required",
            "pendapatan"  => "required",
            "biaya"  => "required",
            
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
            $data['periode_id'] = $this->get_periode_id();
            $data['project_id'] = $request->project;
            $data['pendapatan'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->pendapatan);
            $data['biaya'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->biaya);
            $data['created_at'] = Carbon::now();
            DB::table("tb_pb_project")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data PBL Project berhasil disimpan."], 200);
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
        $project = DB::table("tb_project")->get();
        $data = DB::table("tb_pb_project")->where("id",$id)->first();
        return view("pbl_project.edit",compact("data","id","project"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "project"  => "required",
            "pendapatan"  => "required",
            "biaya"  => "required",
            
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
            $data['project_id'] = $request->project;
            $data['pendapatan'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->pendapatan);
            $data['biaya'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->biaya);
            $data['updated_at'] = Carbon::now();
            DB::table("tb_pbl")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data PBL Project berhasil diupdate."], 200);
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
            DB::table("tb_pbl")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data PBL Project berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
