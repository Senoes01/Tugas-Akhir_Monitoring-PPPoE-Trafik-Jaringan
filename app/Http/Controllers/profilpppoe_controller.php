<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;
use Illuminate\Support\Facades\Session;

class profilpppoe_controller extends Controller
{
    public function index(){
        return view('pppoe.profil');
    }
}
?>
