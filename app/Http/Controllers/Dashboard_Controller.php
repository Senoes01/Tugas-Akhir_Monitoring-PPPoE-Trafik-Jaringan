<?php

namespace App\Http\Controllers;
use App\Models\RouterosAPI;
use Illuminate\Http\Request;
use RouterOS\Query;
use App\Http\Controllers\monitoring_controller;
use function count;

class Dashboard_Controller extends Controller
{
    public function index()
    {
    $ip = session('mikrotik_ip');
    $user = session('mikrotik_user');
    $pass = session('mikrotik_pass');
    $API = new RouterosAPI();
    $API->debug = false;

    $nama_router = 'Tidak ditemukan';
    $model_router = 'Tidak ditemukan';
    $board_name = 'Tidak ditemukan';
    $tanggal = 'Tidak ditemukan';

    if ($API->connect($ip, $user, $pass)) {
        $identitas = $API->comm('/system/identity/print');
        $data_router = $API->comm("/system/routerboard/print");
        $data_resource = $API->comm("/system/resource/print");
        $date = $API->comm('/system/clock/print');

        if (!empty($identitas) && isset($identitas['name'], $data_router['model'], $data_resource['board-name'], $date['date'])) {
            $nama_router = $identitas['name'];
            $model_router = $data_router['model'];
            $board_name = $data_resource['board-name'];
            $tanggal = $date['date'];
        }

        $API->disconnect();
    } else {
        return 'Koneksi Gagal';
    }

    // Ambil data PPPoE dari MonitoringController
    $monitoring = new Monitoring_Controller();
    $data = $monitoring->getPppoeData();

    return view('dashboard', [
        'nama_router' => $nama_router,
        'model_router' => $model_router,
        'board_name' => $board_name,
        'date' => $tanggal,
        'jumlah_pppoe' => $data['jumlah_pppoe'],
        'jumlah_active' => $data['jumlah_active'],
        'interface' =>$data['interface'],
    ]);
    }

    public function Data_Resources()
        {
            $API = new RouterosAPI();

            $ip = session('mikrotik_ip');
            $user = session('mikrotik_user');
            $pass = session('mikrotik_pass');

            if ($API->connect ($ip, $user, $pass)) {
                $Data = $API->comm('/system/resource/print');

            if (!empty($Data) && isset($Data['cpu-load'], $Data['uptime'], $Data['free-hdd-space'], $Data['total-hdd-space'])) {
                $cpuLoad = $Data['cpu-load'];
                $uptimeRaw = $Data['uptime'];
                $free_Hdd = $Data['free-hdd-space'];
                $total_Hdd = $Data['total-hdd-space'];

                preg_match('/(?:(\d+)w)?(?:(\d+)d)?(?:(\d+)h)?(?:(\d+)m)?(?:(\d+)s)?/', $uptimeRaw, $match);

                $weeks   = isset($match[1]) ? (int)$match[1] : 0;
                $days    = isset($match[2]) ? (int)$match[2] : 0;
                $hours   = isset($match[3]) ? str_pad($match[3], 2, '0', STR_PAD_LEFT) : '00';
                $minutes = isset($match[4]) ? str_pad($match[4], 2, '0', STR_PAD_LEFT) : '00';
                $seconds = isset($match[5]) ? str_pad($match[5], 2, '0', STR_PAD_LEFT) : '00';

                $totalDays = ($weeks * 7) + $days;

                $formatUptime = "{$totalDays}d {$hours}:{$minutes}:{$seconds}";

                $formatFreeHdd = $this->formatBytes($free_Hdd);

                $formattotalHdd = $this->formatBytes($total_Hdd);

                return response()->json([
                    'cpu' => $cpuLoad,
                    'uptime' => $formatUptime,
                    'free_hdd' => $formatFreeHdd,
                    'total_hdd' => $formattotalHdd
                ]);
            } else {
                return response()->json(['error' => 'Data tidak Di temukan'], 500);
            }
        }

    }
    private function formatBytes($bytes, $precision = 2)
        {
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);
            $bytes /= pow(1024, $pow);
            return round($bytes, $precision) . ' ' . $units[$pow];
        }

    public function getTrafik($interface)
        {
            $API = new RouterosAPI();

            $ip = session('mikrotik_ip');
            $user = session('mikrotik_user');
            $pass = session('mikrotik_pass');

            if ($API->connect($ip, $user, $pass)) {
                $interfaceData = $API->comm('/interface/monitor-traffic', [
                    "interface" => $interface,
                    "once" => "",
                ]);

                $API->disconnect();

                // Misalnya hasilnya dalam bit/s, bisa diubah ke Kbps atau Mbps
                return response()->json([
                    'rx' => $interfaceData['rx-bits-per-second'] ?? 0,
                    'tx' => $interfaceData['tx-bits-per-second'] ?? 0,
                ]);
            } else {
                return response()->json(['error' => 'Koneksi gagal'], 500);
            }
        }

    }
?>
