<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(){
        return view('welcome');
    }
    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/klinik');
        }
        return redirect('/login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    public function index()
    {
        Paginator::useBootstrap();
        $user = User::paginate(env('PER_PAGE'));
        return view('user.user',compact('user'));
    }

    public function create()
    {
        $klinik = Klinik::all();
        return view('user.create',compact('klinik'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'role'=>'required',
            'klinik_id'=>'required'
        ]);
        if ($request->input('password')){
            $password = bcrypt($request->password);
        }
        else{
            $password = bcrypt('password');
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'klinik_id'=>$request->klinik_id,
            'password'=> $password
        ]);

        return redirect()->back()->with('success', 'data user berhasil ditambah');
    }
    public function edit($id)
    {
        $user = User::findorfail($id);
        $klinik = Klinik::all();
        return view('user.edit',compact('user','klinik'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'role'=>'required',
            'klinik_id'=>'required'
        ]);

        if($request->input('password')){
            $data_user = [
                'name' => $request->name,
                'role'=>$request->role,
                'klinik_id'=>$request->klinik_id,
                'password'=>bcrypt($request->password)
            ];
        }
        else{
            $data_user = [
                'name' => $request->name,
                'role'=>$request->role,
                'klinik_id'=>$request->klinik_id
            ];
        }

        User::whereId($id)->update($data_user);
        return redirect()->route('user.index')->with('success', "data berhasil diubah");
    }
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function loginMobile(Request $request){
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json([
                    'success'=>false,
                    'data'=>null,
                    'message' => 'Unauthorized'
                ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        return response()
            ->json(['success'=>true,
                'data'=>$user,
                'message' => 'Authorized']);
    }
}
