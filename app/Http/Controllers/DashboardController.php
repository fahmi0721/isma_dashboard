<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        $data['periode_active'] = $this->get_periode();
        $data['periode'] = $this->get_periode_all();
        $data['produksi_spjm'] = $this->get_produksi(1);
        $data['produksi_pms'] = $this->get_produksi(2);
        $data['produksi_jai'] = $this->get_produksi(3);
        // dd($data);
        return view("index",compact("data"));
    }

    public function produksi(){
        $data['periode_active_name'] = $this->get_peridoe_active_name($this->get_peridoe_active());
        $data['periode_active'] = $this->get_peridoe_active();
        $data['periode'] = $this->get_periode_all();
        $data['entitas'] = $this->count_entitas();
        $data['project'] = $this->count_project();
        $data['segmen'] = $this->count_segmen();
        $data['tenaga_kerja'] = $this->tenaga_kerja_count($this->get_peridoe_active());
        return view("dashboard.produksi",compact("data"));
    }

    public function keuangan(){
        $data['periode_active_name'] = $this->get_peridoe_active_name($this->get_peridoe_active());
        $data['periode_active'] = $this->get_peridoe_active();
        $data['periode'] = $this->get_periode_all();
        $data['pbl'] = $this->get_pbl($this->get_peridoe_active());
        $data['entitas'] = $this->count_entitas();
        $data['project'] = $this->count_project();
        $data['segmen'] = $this->count_segmen();
        $data['tenaga_kerja'] = $this->tenaga_kerja_count($this->get_peridoe_active());
        return view("dashboard.keuangan",compact("data"));
    }

    private function get_pbl($periode_id){
        $pbl = DB::table("tb_pbl")->select(DB::raw("round((pendapatan/1000000000),2) as pendapatan"),DB::raw("round((biaya/1000000000),2) as biaya"),DB::raw("round((laba_rugi/1000000000),2) as laba_rugi"))->where("periode_id",$periode_id)->first();
        return $pbl;
    }

    public function chart_keuangan(Request $request){
        $data = array();
        $periode_id = $request->periode_id;
        $data['laba_rugi'] = $this->laba_rugi_periode_aktif($periode_id);
        $data['laba_rugi_project'] = $this->laba_rugi_project($periode_id);
        $data['pendapatan_project'] = $this->pendapatan_project($periode_id);
        $data['biaya_project'] = $this->biaya_project($periode_id);
        $data['pbl'] = $this->get_pbl($periode_id);
        $data['pb'] = $this->get_pb($periode_id);
        // echo "<pre>";
        // print_r($data);
        return response()->json(['status'=>'success', 'messages'=>"Load data sukses.","result" => $data], 200);
    }

    private function get_produksi_by_entitas($periode_id){
        $data = array();
        $periode = $this->get_peridoe_active_name($periode_id);
        $entitas = DB::table("tb_entitas")
                    ->select("tb_entitas.nama",DB::raw("SUM(tb_tenaga_kerja.jumlah_tk) as tot"))
                    ->join("tb_project","tb_entitas.id","=","tb_project.entitas_id")
                    ->join("tb_tenaga_kerja","tb_project.id","=","tb_tenaga_kerja.project_id")
                    ->where("tb_tenaga_kerja.periode_id",$periode_id)
                    ->groupBy("tb_project.entitas_id")
                    ->get();
        $posisi=0;
        $borderColor = array('rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)','rgba(252, 21, 202, 1)');
        $bgColor = array('rgba(255,99,132,0.8)','rgba(54, 162, 235, 0.8)','rgba(255, 206, 86, 0.8)','rgba(75, 192, 192, 0.8)','rgba(153, 102, 255, 0.8)','rgba(255, 159, 64, 0.8)','rgba(29, 252, 21, 0.8)','rgba(198, 21, 252, 0.8)','rgba(252, 21, 202, 0.8)');
        $data['labels'] = array($periode);
        foreach($entitas as $dt_enritas){
            $data['datasets'][$posisi]['label'] = $dt_enritas->nama;
            $data['datasets'][$posisi]['data'] = array($dt_enritas->tot);
            $data['datasets'][$posisi]['borderColor'] = $borderColor[$posisi];
            $data['datasets'][$posisi]['backgroundColor'] = $bgColor[$posisi];
            $posisi++;
        }
        return $data;
    }

    private function get_produksi_by_project($periode_id){
        $data = array();
        $periode = $this->get_peridoe_active_name($periode_id);
        $project = DB::table("tb_project")
                    ->select("tb_project.deskripsi",DB::raw("SUM(tb_tenaga_kerja.jumlah_tk) as tot"))
                    ->join("tb_tenaga_kerja","tb_project.id","=","tb_tenaga_kerja.project_id")
                    ->where("tb_tenaga_kerja.periode_id",$periode_id)
                    ->groupBy("tb_project.id")
                    ->get();
        $posisi=0;
        $borderColor = array('rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)','rgba(252, 21, 202, 1)');
        $bgColor = array('rgba(255,99,132,0.8)','rgba(54, 162, 235, 0.8)','rgba(255, 206, 86, 0.8)','rgba(75, 192, 192, 0.8)','rgba(153, 102, 255, 0.8)','rgba(255, 159, 64, 0.8)','rgba(29, 252, 21, 0.8)','rgba(198, 21, 252, 0.8)','rgba(252, 21, 202, 0.8)');
        $data['labels'] = array($periode);
        foreach($project as $dt_project){
            $data['datasets'][$posisi]['label'] = $dt_project->deskripsi;
            $data['datasets'][$posisi]['data'] = array($dt_project->tot);
            $data['datasets'][$posisi]['borderColor'] = $borderColor[$posisi];
            $data['datasets'][$posisi]['backgroundColor'] = $bgColor[$posisi];
            $posisi++;
        }
        return $data;
    }

    private function get_produksi_by_job($periode_id){
        $data = array();
        $periode = $this->get_peridoe_active_name($periode_id);
        $job = DB::table("tb_jabatan")
                    ->select("tb_jabatan.nama",DB::raw("SUM(tb_tenaga_kerja.jumlah_tk) as tot"))
                    ->join("tb_tenaga_kerja","tb_jabatan.id","=","tb_tenaga_kerja.job_id")
                    ->where("tb_tenaga_kerja.periode_id",$periode_id)
                    ->groupBy("tb_jabatan.id")
                    ->get();
        $posisi=0;
        $borderColor = array('rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)','rgba(252, 21, 202, 1)');
        $bgColor = array('rgba(255,99,132,0.8)','rgba(54, 162, 235, 0.8)','rgba(255, 206, 86, 0.8)','rgba(75, 192, 192, 0.8)','rgba(153, 102, 255, 0.8)','rgba(255, 159, 64, 0.8)','rgba(29, 252, 21, 0.8)','rgba(198, 21, 252, 0.8)','rgba(252, 21, 202, 0.8)');
        $data['labels'] = array($periode);
        foreach($job as $dt_job){
            $data['datasets'][$posisi]['label'] = $dt_job->nama;
            $data['datasets'][$posisi]['data'] = array($dt_job->tot);
            $data['datasets'][$posisi]['borderColor'] = $borderColor[$posisi];
            $data['datasets'][$posisi]['backgroundColor'] = $bgColor[$posisi];
            $posisi++;
        }
        return $data;
    }

    private function get_produksi_by_segmen($periode_id){
        $data = array();
        $periode = $this->get_peridoe_active_name($periode_id);
        $segmen = DB::table("tb_project")
                    ->select("tb_kategori_project.nama",DB::raw("SUM(tb_tenaga_kerja.jumlah_tk) as tot"))
                    ->join("tb_tenaga_kerja","tb_project.id","=","tb_tenaga_kerja.project_id")
                    ->join("tb_kategori_project","tb_kategori_project.id","=","tb_project.kategori_id")
                    ->where("tb_tenaga_kerja.periode_id",$periode_id)
                    ->groupBy("tb_project.kategori_id")
                    ->get();
        $posisi=0;
        $borderColor = array('rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)','rgba(252, 21, 202, 1)');
        $bgColor = array('rgba(255,99,132,0.8)','rgba(54, 162, 235, 0.8)','rgba(255, 206, 86, 0.8)','rgba(75, 192, 192, 0.8)','rgba(153, 102, 255, 0.8)','rgba(255, 159, 64, 0.8)','rgba(29, 252, 21, 0.8)','rgba(198, 21, 252, 0.8)','rgba(252, 21, 202, 0.8)');
        $data['labels'] = array($periode);
        foreach($segmen as $dt_segmen){
            $data['datasets'][$posisi]['label'] = $dt_segmen->nama;
            $data['datasets'][$posisi]['data'] = array($dt_segmen->tot);
            $data['datasets'][$posisi]['borderColor'] = $borderColor[$posisi];
            $data['datasets'][$posisi]['backgroundColor'] = $bgColor[$posisi];
            $posisi++;
        }
        return $data;
    }

    public function chart_produksi(Request $request){
        $data = array();
        $periode_id = $request->periode_id;
        $data['tenaga_kerja'] = number_format($this->tenaga_kerja_count($periode_id)->jumlah_tk,0,',','.');
        $data['periode_active_name'] = $this->get_peridoe_active_name($periode_id);
        $data['entitas'] = $this->get_produksi_by_entitas($periode_id);
        $data['project'] = $this->get_produksi_by_project($periode_id);
        $data['job'] = $this->get_produksi_by_job($periode_id);
        $data['segmen'] = $this->get_produksi_by_segmen($periode_id);
        return response()->json(['status'=>'success', 'messages'=>"Load data sukses.","result" => $data], 200);
                    
    }

    private function get_peridoe_active_name($id){
        $res = DB::table("tb_periode")->select(DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$id);
        if($res->count() == 1){
            $ress = $res->first();
            return $ress->nama;
        }else{
            return "";
        }
    }

    private function tenaga_kerja_count($periode_id){
        $count_tenaga_kerja = DB::table("tb_tenaga_kerja")->select(DB::raw("SUM(jumlah_tk) as jumlah_tk"))->where("periode_id",$periode_id)->first();
        return $count_tenaga_kerja;
    }

    private function count_entitas(){
        $count_entitas = DB::table("tb_entitas")->count();
        return $count_entitas;
    }

    private function count_project(){
        $count_project = DB::table("tb_project")->count();
        return $count_project;
    }

    private function count_segmen(){
        $count_segmen = DB::table("tb_kategori_project")->count();
        return $count_segmen;
    }

    private function get_periode_all(){
        $periode = DB::table("tb_periode")->select(DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') AS nama"),"id")->orderBy("id","desc")->get();
        return $periode;
    }


    private function get_produksi($id_entitas){
        $periode = $this->get_peridoe_active();
        $sql = "SELECT tb_entitas.deskripsi, SUM(tb_tenaga_kerja.jumlah_tk) AS tot
                FROM tb_project 
                INNER JOIN tb_tenaga_kerja ON tb_tenaga_kerja.project_id = tb_project.id
                INNER JOIN tb_entitas ON tb_entitas.id = tb_project.entitas_id
                WHERE tb_project.entitas_id = ".$id_entitas." AND tb_tenaga_kerja.periode_id = ".$periode;
        $query = DB::select(DB::raw($sql)->getValue(DB::getQueryGrammar()));
        return $query[0];
    }

    private function get_peridoe_active(){
        $periode = DB::table("tb_periode")->where("status","1");
        if($periode->count() == 1){
            $per = $periode->first();
            return $per->id;
        }else{
            return 0;
        }
    }

    private function get_periode(){
        $periode = DB::table("tb_periode")->where("status","1");
        if($periode->count() == 1){
            $per = $periode->first();
            return $this->set_name_periode($per->nama);
        }else{
            return "XX";
        }
    }

    private function set_name_periode($periode){
        $bulans = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Aprl",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Agus",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des",
        );
        $split = explode("-",$periode);
        $tahun = $split[0];
        $bulan = $bulans[$split[1]];
        return $bulan . " " . $tahun;
    }

    private function get_pb($periode_id){
        $data = array();
        $pendapatans = array();
        $biayas = array();
        $periode = DB::table("tb_periode")->select("id",DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$periode_id)->first();
        $pbl = DB::table("tb_pbl")->select(DB::raw("round((pendapatan/1000000000),2) as pendapatan"),DB::raw("round((biaya/1000000000),2) as biaya"),DB::raw("round((laba_rugi/1000000000),2) as laba_rugi"))->where("periode_id",$periode_id);
        if($pbl->count() == 1){
            $laba = $pbl->first();
            $pendapatan = $laba->pendapatan;
            $biaya = $laba->biaya;
            $data['labels'][] = $periode->nama;
            $pendapatans[] = (float) $pendapatan;
            $biayas[] = (float) $biaya;
        }
        $data['dataset'][0]['label'] = "Pendapatan (Miliyar)";
        $data['dataset'][0]['data'] = $pendapatans;
        $data['dataset'][0]['backgroundColor'] = 'rgba(54, 162, 235, 1)';

        $data['dataset'][1]['label'] = "Biaya (Miliyar)";
        $data['dataset'][1]['data'] = $biayas;
        $data['dataset'][1]['backgroundColor'] = 'rgba(255, 206, 86, 1)';
        return $data;

    }

    private function pendapatan_project($periode_id){
        $data = array();
        $datas = array();
        $bgcolor = array('rgba(75, 192, 192, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)');
        $periode = DB::table("tb_periode")->select("id",DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$periode_id)->first();
        $pbl =  DB::table("tb_pb_project")
                ->select("tb_project.deskripsi",DB::raw("round((tb_pb_project.pendapatan/1000000000),2) as pendapatan"))
                ->join("tb_project","tb_project.id","=","tb_pb_project.project_id")
                ->where("tb_pb_project.periode_id",$periode_id);
        if($pbl->count() > 1){
            $dt = $pbl->get();
            $posisi =0;
            $data['labels'][] = $periode->nama;
            foreach($dt as $res){
                $pendapatan = $res->pendapatan;
                $data['dataset'][$posisi]['label'] = $res->deskripsi." (Miliyar)";
                $data['dataset'][$posisi]['data'][] = (float) $pendapatan;
                $data['dataset'][$posisi]['backgroundColor'] = $bgcolor[$posisi];
                $posisi++;
            }

        }
        return $data;
    }

    private function biaya_project($periode_id){
        $data = array();
        $datas = array();
        $bgcolor = array('rgba(75, 192, 192, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)');
        $periode = DB::table("tb_periode")->select("id",DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$periode_id)->first();
        $pbl =  DB::table("tb_pb_project")
                ->select("tb_project.deskripsi",DB::raw("round((tb_pb_project.biaya/1000000000),2) as biaya"))
                ->join("tb_project","tb_project.id","=","tb_pb_project.project_id")
                ->where("tb_pb_project.periode_id",$periode_id);
        if($pbl->count() > 1){
            $dt = $pbl->get();
            $posisi =0;
            $data['labels'][] = $periode->nama;
            foreach($dt as $res){
                $biaya = $res->biaya;
                $data['dataset'][$posisi]['label'] = $res->deskripsi." (Miliyar)";
                $data['dataset'][$posisi]['data'][] = (float) $biaya;
                $data['dataset'][$posisi]['backgroundColor'] = $bgcolor[$posisi];
                $posisi++;
            }

        }
        return $data;
    }

    private function laba_rugi_project($periode_id){
        $data = array();
        $datas = array();
        $bgcolor = array('rgba(75, 192, 192, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(29, 252, 21, 1)','rgba(198, 21, 252, 1)');
        $periode = DB::table("tb_periode")->select("id",DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$periode_id)->first();
        $pbl =  DB::table("tb_pb_project")
                ->select("tb_project.deskripsi",DB::raw("round(((tb_pb_project.pendapatan-tb_pb_project.biaya)/1000000000),2) as laba_rugi"))
                ->join("tb_project","tb_project.id","=","tb_pb_project.project_id")
                ->where("tb_pb_project.periode_id",$periode_id);
        if($pbl->count() > 1){
            $dt = $pbl->get();
            $posisi =0;
            $data['labels'][] = $periode->nama;
            foreach($dt as $res){
                $laba_rugi = $res->laba_rugi;
                $data['dataset'][$posisi]['label'] = $res->deskripsi." (Miliyar)";
                $data['dataset'][$posisi]['data'][] = (float) $laba_rugi;
                $data['dataset'][$posisi]['backgroundColor'] = $bgcolor[$posisi];
                $posisi++;
            }

        }
        return $data;
    }

    private function laba_rugi_periode_aktif($periode_id){
        $data = array();
        $datas = array();
        $periode = DB::table("tb_periode")->select("id",DB::raw("DATE_FORMAT(CONCAT(nama,'-01'),'%M %Y') as nama"))->where("id",$periode_id)->first();
        $pbl = DB::table("tb_pbl")->select(DB::raw("round((pendapatan/1000000000),2) as pendapatan"),DB::raw("round((biaya/1000000000),2) as biaya"),DB::raw("round((laba_rugi/1000000000),2) as laba_rugi"))->where("periode_id",$periode_id);
        if($pbl->count() == 1){
            $laba = $pbl->first();
            $laba_rugi = $laba->laba_rugi;
            $data['labels'][] = $periode->nama;
            $datas[] = (float) $laba_rugi;
        }
        $data['dataset'][0]['label'] = "Laba Rugi (Miliyar)";
        $data['dataset'][0]['data'] = $datas;
        $data['dataset'][0]['backgroundColor'] = 'rgba(75, 192, 192, 1)';
        return $data;
    }

    public function laba_rugi(){
        $year = date("Y");
        $bulans = array(
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
        $data = array();
        $posisi =0;
        $pengali =1;
        foreach($bulans as $key => $bulan){
            $prd = $year."-".$key;
            $periode = DB::table("tb_periode")->where("nama",$prd);
            if($periode->count() == 1){
                $p = $periode->first();
                $lr = DB::table("tb_pbl")->select(DB::raw("round((laba_rugi/1000000000),2) as laba_rugi"),DB::raw("(pendapatan/1000000000) as pendapatan"),DB::raw("(biaya/1000000000) as biaya"))->where("periode_id",$p->id);
                $rkap = DB::table("tb_rkap")->select(DB::raw("round(((laba_rugi/1000000000)/12),2) as laba_rugi"),DB::raw("round(((pendapatan/1000000000)/12),2) as pendapatan"),DB::raw("round(((biaya/1000000000)/12),2) as biaya"));
                if($lr->count() == 1 && $rkap->count() == 1){
                    $laba = $lr->first();
                    $r_kap = $rkap->first();
                    $laba_rugi = $laba->laba_rugi;
                    $rk_ap = $r_kap->laba_rugi * $pengali;
                    $data['labels'][$posisi] = $bulan;
                    $data['laba_rugi']['dataset'][0]['label'] = "Laba Rugi (Miliyar)";
                    $data['laba_rugi']['dataset'][0]['data'][$posisi] = $laba_rugi;
                    $data['laba_rugi']['dataset'][0]['backgroundColor'][] = "rgba(75, 192, 192, 0.5)";
                    $data['laba_rugi']['dataset'][0]['borderColor'][] = "rgba(75, 192, 192, 1)";
                    $data['laba_rugi']['dataset'][0]['borderWidth'] = 1.5;
                    $data['laba_rugi']['dataset'][0]['fill'] = false;
                    $data['laba_rugi']['dataset'][1]['label'] = "RKAP (Miliyar)";
                    $data['laba_rugi']['dataset'][1]['data'][$posisi] = $rk_ap;
                    $data['laba_rugi']['dataset'][1]['backgroundColor'][] = "rgba(90, 33, 248, 0.5)";
                    $data['laba_rugi']['dataset'][1]['borderColor'][] = "rgba(90, 33, 248, 1)";
                    $data['laba_rugi']['dataset'][1]['borderWidth'] = 1.5;
                    $data['laba_rugi']['dataset'][1]['fill'] = false;

                    $data['pb']['dataset'][0]['label'] = "Pendapatan (Miliyar)";
                    $data['pb']['dataset'][0]['data'][$posisi] = $laba->pendapatan;
                    $data['pb']['dataset'][0]['backgroundColor'][] = "rgb(253, 168, 11)";
                    $data['pb']['dataset'][1]['label'] = "RKAP Pendapatan (Miliyar)";
                    $data['pb']['dataset'][1]['data'][$posisi] = $r_kap->pendapatan * $pengali;
                    $data['pb']['dataset'][1]['backgroundColor'][] = "rgba(90, 33, 248, 1)";

                    $data['pb']['dataset'][2]['label'] = "Biaya (Miliyar)";
                    $data['pb']['dataset'][2]['data'][$posisi] = $laba->biaya;
                    $data['pb']['dataset'][2]['backgroundColor'][] = "rgb(253, 11, 84)";
                    $data['pb']['dataset'][3]['label'] = "RKAP Biaya (Miliyar)";
                    $data['pb']['dataset'][3]['data'][$posisi] = $r_kap->biaya * $pengali;
                    $data['pb']['dataset'][3]['backgroundColor'][] = "rgb(133, 33, 248)";

                    $data['pendapatan'][$posisi] = $laba->pendapatan;
                    $data['biaya'][$posisi] = $laba->biaya;
                }
            }
            $posisi++;
            $pengali++;
        }
        return response()->json(['status'=>'success', 'messages'=>"Load data sukses.","result" => $data], 200);
    }

    
}
