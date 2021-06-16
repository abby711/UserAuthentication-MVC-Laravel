<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use App\UserLogin;
use App\Models\User;
use Session;
use Crypt;

class userLogin extends Controller
{


    function registerUser(Request $req)
    {
        

        $validateData = $req->validate([
        'name' => 'required|regex:/^[a-z A-Z]+$/u',
        'email' => 'required|email',
        'password' => 'required|min:8|max:8',
        'confirm_password' => 'required|same:password',
        //'mobile' => 'numeric|required|digits:10'
        ]);
        
        $result = DB::table('users')
        ->where('email',$req->input('email'))
        ->get();
        
        $res = json_decode($result,true);
        print_r($res);
        
        if(sizeof($res)==0){
            $data = $req->input();
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $encrypted_password = crypt::encrypt($data['password']);
        $user->password = $encrypted_password;
        //$user->mobile = $data['mobile'];
        $user->save();
        $req->session()->flash('register_status','User has been registered successfully');
        return redirect('/');
        }
        else{
        $req->session()->flash('register_status','This Email already exists.');
        return redirect('/register');
        }
    }

    function loginUser(Request $req){
            $validatedData = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
            ]);
            
            $result = DB::table('users')
            ->where('email',$req->input('email'))
            ->get();
            
            $res = json_decode($result,true);
            print_r($res);
            
            if(sizeof($res)==0){
            $req->session()->flash('error','Email Id does not exist. Please register yourself first');
            echo "Email Id Does not Exist.";
            return redirect('login');
            }
            else{
                 echo "Hello";
                $encrypted_password = $result[0]->password;
                $decrypted_password = crypt::decrypt($encrypted_password);
                if($decrypted_password==$req->input('password')){
                        echo "You are logged in Successfully";
                        $req->session()->put('user',$result[0]->name);
                        return redirect('/');
                    }
                else{
                        $req->session()->flash('error','Password Incorrect!!!');
                        echo "Email Id Does not Exist.";
                        return redirect('login');
                    }
            }
    }
    public function logout(Request $request ) {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');

        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
