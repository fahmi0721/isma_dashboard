<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Validator;

class LoginController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('login');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('login');
    }

    public function login(Request $request) {
        $validates 	= [
            "email"  => "required|email",
            "password"  => "required|min:8",
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }
        
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (!$login = auth()->attempt($credentials)) {
                return response()->json(['status' => 'warning','messages' => 'Email atau password yang anda masukkan tidak benar!'], 401);
            }
            return response()->json(['status'=>'success', 'messages'=>'Proses login yang kamu lakukan berhasil.'], 201);
        } catch(QueryException $e) { 
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
    }

    public function lupa_password(){
        return view("auth.lupa_password");
    }

    public function form_reset_password(Request $request){
        $data = DB::table("password_reset_tokens")->select("email")->where("token",$request->kode_reset)->first();
        if(!empty($data->email)){
            return view("auth.reset_password",compact("data"));
        }else{
            return abort(404);
        }
    }

    public function generate_token(Request $request){
        $validates 	= [
            "email"  => "required|email",
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }

        try {
            $cekemail =DB::table("users")->select("emaail")->where("email",$request->email)->count();        
            if($cekemail <=0){
                return response()->json(['status'=>'warning', 'messages'=>"email yang anda masukkan tidak ditemukan!"], 422);
            }
            $cekemailrset = DB::table("password_reset_tokens")->select("emaail")->where("email",$request->email)->count();
            if($cekemailrset > 0){
                return response()->json(['status'=>'warning', 'messages'=>"anda telah melakukan reset password, silahkan cek email anda"], 422);
            }
            $kodeReset = Str::random(200);
            DB::beginTransaction();
            $data['email'] = $request->email;
            $data['token'] = $kodeReset;
            $data['created_at'] = Carbon::now();
            DB::table("password_reset_tokens")->insert($data);
            $this->send_mail($request->email,$kodeReset);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Berhasil melakukan reset password. Cek email anda untuk untuk mendapatkan link reset password"], 201);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
    }

    public function send_mail($email,$kode_reset){
        $data['nama'] = "Reset Password";
        $data['body'] = "Klik link dibawah ini untuk mereset password Anda";
        $data['link'] = env("APP_URL")."reset-password/?kode_reset=".$kode_reset;
        Mail::to($email)->send(new ResetPassword($data));
    }

    public function password_update(Request $request){
        $validates 	= [
            "email"  => "required|email",
            "kode_reset"  => "required",
            'password' => 'required|confirmed|min:8'
        ];
        $validation = Validator::make($request->all(), $validates);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }

        try {
            $data['password'] = \Hash::make($request->password);
            $data['updated_at'] = Carbon::now();
            DB::table("users")->where("email",$request->email)->update($data);
            // DB::table("password_reset_tokens")->where("email",$request->email)->delete($data);
            DB::delete("DELETE FROM password_reset_tokens WHERE token = '".$request->kode_reset."'");
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Password anda berhasil direset"], 201);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  

        
    }
}
