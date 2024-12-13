<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str; 
use DataTables;
use Validator;
class TenagaKerjaController extends Controller
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
            $query = DB::table("tb_tenaga_kerja")
                    ->select("tb_tenaga_kerja.*",DB::raw("tb_project.nama as project"),DB::raw("tb_periode.nama as periode"),DB::raw("tb_jabatan.nama as job"))
                    ->join("tb_project","tb_project.id","=","tb_tenaga_kerja.project_id")
                    ->join("tb_periode","tb_periode.id","=","tb_tenaga_kerja.periode_id")
                    ->join("tb_jabatan","tb_jabatan.id","=","tb_tenaga_kerja.job_id")
                    ->orderBy("tb_tenaga_kerja.id","desc")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("tenaga_kerja.index");
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
        $data['project'] = DB::table("tb_project")->select("id","nama","kode")->get();
        $data['job'] = DB::table("tb_jabatan")->select("id","nama")->get();
        if($this->cek_periode() > 0){
            $data['periode'] = $this->get_periode();
        }else{
            $data['periode'] = "Periode belum aktif";
        }
        $periode = $this->cek_periode();
        return view("tenaga_kerja.tambah",compact("data","periode"));
    }

    public function tipe_jabatan(Request $request){
        $tipe_jabatan = DB::table("tb_tipe_jabatan")->select("tb_tipe_jabatan.nama")->join("tb_jabatan","tb_jabatan.job_type_id","=","tb_tipe_jabatan.id")->where("tb_jabatan.id",$request->job_id)->first();
        return json_encode($tipe_jabatan);
    }

    public function tipe_jabatan_id($job_id){
        $tipe_jabatan = DB::table("tb_tipe_jabatan")->select("tb_tipe_jabatan.id")->join("tb_jabatan","tb_jabatan.job_type_id","=","tb_tipe_jabatan.id")->where("tb_jabatan.id",$job_id)->first();
        return $tipe_jabatan->id;
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            "project"  => "required",
            "job"  => "required",
            "jumlah_tenaga_kerja"  => "required",
            
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
            $data['periode_id'] = $this->get_periode_id();
            $data['job_id'] = $request->job;
            $data['job_type_id'] = $this->tipe_jabatan_id($request->job);
            $data['jumlah_tk'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->jumlah_tenaga_kerja);
            $data['created_at'] = Carbon::now();
            DB::table("tb_tenaga_kerja")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jumlah Tenaga Kerja berhasil disimpan."], 200);
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
        $data['tenaga_kerja'] = DB::table("tb_tenaga_kerja")->where("id",$id)->first();
        $data['project'] = DB::table("tb_project")->select("id","nama","kode")->get();
        $data['job'] = DB::table("tb_jabatan")->select("id","nama")->get();
        $data['job_type'] = DB::table("tb_tipe_jabatan")->select("id","nama")->where("id",$data['tenaga_kerja']->job_type_id)->first();
        return view("tenaga_kerja.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "project"  => "required",
            "job"  => "required",
            "jumlah_tenaga_kerja"  => "required",
            
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
            $data['job_id'] = $request->job;
            $data['job_type_id'] = $this->tipe_jabatan_id($request->job);
            $data['jumlah_tk'] = Str::replaceMatches(pattern: '/[^A-Za-z0-9]++/',replace: '',subject: $request->jumlah_tenaga_kerja);
            $data['updated_at'] = Carbon::now();
            DB::table("tb_tenaga_kerja")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jumlah Tenaga Kerja berhasil diupdate."], 200);
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
            DB::table("tb_tenaga_kerja")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data Jumlah Tenaga Kerja berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
