<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller{

    // get lst
    public function index()
    {
       return view('products.list');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }

        if ($user && Hash::check($password, $user->password)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }

    }

    
    public function dashboard()
    {
        return view('dashboard');
    }

    
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->to('/');
    }

}