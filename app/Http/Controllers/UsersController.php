<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }

    public function index() {
        $users = DB::table("users")->get();
        return view('users', ["users"=>$users]);
    }

    public function delete($id) {
        DB::table("users")->where("id", $id)->delete();
        return redirect('users');
    }

    public function get ($id, Request $request){
        $user = DB::table("users")->where("id", $id)->get();
        if ($request->ajax()) {
            return Response::json($user);
        } else {
            abort(403, "Nemate direktan pristup ovom djelu sustava");
        }
    }

    public function store(Request $request){
        $data = $request->all();
        
        $validationData = [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'oid' => ['required', 'string', 'min:13', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:administrator,učenik,nastavnik'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ];

        if (isset($data["id"])) {
            $validationData = [
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'oid' => ['required', 'string', 'min:13'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => ['required', 'in:administrator,učenik,nastavnik']
            ];
        }
        $validator = Validator::make($data, $validationData);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); 
            } else {
                return redirect('users')->withErrors($validator)->withInput();
            }   
        } else {
            if (isset($data["id"])){
                if ($data["password"] == ""){
                    unset($data["password"]);
                    unset($data["password_confirmation"]);
                } else
                    $data["password"] = Hash::make($data['password']);
                $user = User::findOrFail($data["id"]);
                $user->fill($data)->save();
            } else
            User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'oid' => $data['oid'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);
            if ($request->ajax()) return Response::json(array('success' => true), 200);
            return redirect("users");
        }
    }
}
