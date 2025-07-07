<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RouterosAPI;

class All_LogController extends Controller
{
    public function ambilDanSimpanLog()
    {
        $ip   = session('mikrotik_ip');
        $user = session('mikrotik_user');
        $pass = session('mikrotik_pass');

        $API = new RouterosAPI();

        if ($API->connect($ip, $user, $pass)) {
            $hasil = $API->comm('/log/print');

            // Pastikan hasil selalu array banyak
            if (isset($hasil['.id'])) {
                $hasil = [$hasil];
            }

            $total = 0;
            for ($i = 0; $i < count($hasil); $i++) {
                $id = $hasil[$i]['.id'] ?? null;

                if ($id) {
                    $sudahAda = DB::table('semua_log')->where('id', $id)->exists();

                    if (!$sudahAda) {
                        DB::table('semua_log')->insert([
                            'id'         => $id,
                            'time'       => $hasil[$i]['time'] ?? now()->format('H:i:s'),
                            'topics'     => $hasil[$i]['topics'] ?? '',
                            'message'    => $hasil[$i]['message'] ?? '',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $total++;
                    }
                }
            }

            $API->disconnect();
            return response()->json(['status' => "$total log berhasil disimpan"]);
        } else {
            return response()->json(['error' => 'Gagal konek ke Mikrotik']);
        }
    }

    public function ambilNotifikasi()
    {
        $notif = DB::table('semua_log')
            ->where('topics', 'like', '%pppoe%')
            ->where(function($query) {
                $query->where('message', 'like', '%disconnect%')
                    ->orWhere('message', 'like', '%timed out%')
                    ->orWhere('message', 'like', '%authentication failed%');
            })
            ->orderBy('time', 'desc')
            ->limit(10)
            ->get();

        return response()->json($notif);
    }
}
