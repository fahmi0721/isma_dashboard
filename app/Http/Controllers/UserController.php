<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use Validator;
class UserController extends Controller
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
            $query = DB::table("users")->get();
            return  Datatables::of($query)->make(true);
        }else{
            return view("user.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.tambah");
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validates 	= [
            'nama' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
            
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
            $data['email'] = $request->email;
            $data['level'] = $request->level;
            $data['password'] = \Hash::make($request->password);
            $data['created_at'] = Carbon::now();
            DB::table("users")->insert($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data User berhasil disimpan."], 200);
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
        $data = DB::table("users")->where("id",$id)->first();
        return view("user.edit",compact("data","id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validates 	= [
            "nama"  => "required",
            "email"  => "required|email",
            "level"  => "required",
            
        ];
        if(!empty($request->change_password)){
            $validates += [
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'
            ];
        }
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
            $data['email'] = $request->email;
            $data['level'] = $request->level;
            if(!empty($request->change_password)){
                $data['password'] = \Hash::make($request->password);
            }
            $data['updated_at'] = Carbon::now();
            DB::table("users")->where("id",$request->id)->update($data);
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data User berhasil diupdate."], 200);
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
            DB::table("users")->where("id",$id)->delete();
            DB::commit();
            return response()->json(['status'=>'success', 'messages'=>"Data User berhasil dihapus."], 200);
        } catch(QueryException $e) { 
            DB::rollback();
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }
    }
}
