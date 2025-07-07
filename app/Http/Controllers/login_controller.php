<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;
use Illuminate\Support\Facades\Session;

class Login_controller extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'username' => 'required',
            'password' => 'required',
        ]);

        $API = new RouterosAPI();
        $API->debug = false;

        if ($API->connect($request->ip, $request->username, $request->password)) {
            session([
                'mikrotik_ip' => $request->ip,
                'mikrotik_user' => $request->username,
                'mikrotik_pass' => $request->password,
            ]);

            $API->disconnect();
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['login' => 'Gagal login ke MikroTik. Cek kembali IP, Username, Password.']);
        }
    }
}
?>
