<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\usuario;
class Login extends Controller
{
    

    public function comprobar(Request $request) {
        $_sEmail = $_POST['email'];
        $_sPassword = md5($_POST['password']);
        $admin = usuario::login($_sEmail,$_sPassword);
        if($admin > 0) {
            $request->session()->put('admin',$_sEmail);
            return redirect('/');
        }
        else {
            $mensaje =  'Fallo en el logueo';
            return back()->with('error',$mensaje);
        }
    }

    public function logOut(Request $request) {
        $request->session()->forget('admin');
        return redirect('/');
    } 
}
