<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterosAPI;
use RouterOS\Client;
use RouterOS\Query;
use Illuminate\Support\Facades\Session;

class monitoring_controller extends Controller
{
    public function getPppoeData(){
        // 1. Setup koneksi MikroTik
        $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
        ]);

        // 2. Query untuk ambil data ppp active
        $secrets = new Query('/ppp/secret/print');
        $active = new Query('/ppp/active/print');
        $ether = new Query('/interface/ethernet/print');

        // 3. Jalankan query
        $pppoeSecrets = $client->query($secrets)->read();
        $pppoeActive = $client->query($active)->read();
        $interface = $client->query($ether)->read();

        // Filter hanya service pppoe
        $pppoeOnly = array_filter($pppoeSecrets, function ($item) {
        return isset($item['service']) && $item['service'] === 'pppoe';
        });

        $jumlah_pppoe = count($pppoeOnly);
        $jumlah_active = count($pppoeActive);

        return [
        'pppoeSecrets' => $pppoeSecrets,
        'pppoeActive' => $pppoeActive,
        'jumlah_pppoe' => $jumlah_pppoe,
        'jumlah_active' => $jumlah_active,
        'interface' => $interface,
        ];
    }

    public function index()
    {
    $data = $this->getPppoeData();

        return view('pppoe.monitoring', [
            'pppoeSecrets' => $data['pppoeSecrets'],
            'pppoeActive' => $data['pppoeActive'],
        ]);
    }

    public function destroy($id)
    {
        try {
            $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
            ]);

            $deleteSecret = (new Query('/ppp/secret/remove'))->equal('.id', $id);
            $client->query($deleteSecret)->read();

            return redirect()->route('pppoe.monitoring')->with('success', 'Client berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pppoe.monitoring')->with('error', 'Gagal menghapus client: ' . $e->getMessage());
        }
    }
    public function removeActive(Request $request)
    {
    $client = new Client([
        'host' => session('mikrotik_ip'),
        'user' => session('mikrotik_user'),
        'pass' => session('mikrotik_pass'),
    ]);

    $id = $request->id;

    $removeQuery = new Query('/ppp/active/remove');
    $removeQuery->equal('.id', $id);

    $client->query($removeQuery)->read();

    return redirect()->back()->with('success', 'Client aktif berhasil diputuskan!');
    }
}
?>
