<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class clientpppoe_controller extends Controller
{
    public function index()
    {
        // Inisialisasi koneksi ke Mikrotik
        $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
        ]);


        // Ambil data active PPPoE, profil, dan secret
        $pppoeActive = $client->query(new Query('/ppp/active/print'))->read();
        $pppoeProfil = $client->query(new Query('/ppp/profile/print'))->read();
        $pppoeSecrets = $client->query(new Query('/ppp/secret/print'))->read();
        $services = [
            'any',
            'pppoe'
        ];

        return view('pppoe.client', compact('pppoeActive', 'pppoeProfil', 'pppoeSecrets','services'));
    }


    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'service' => 'required|string',
            'profile' => 'required|string',
            'local_address' => 'required|string',
            'remote_address' => 'required|string',
        ]);

        try {
        // Koneksi ke Mikrotik
        $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
        ]);


        // Tambahkan PPPoE Secret Baru
        $addSecret = (new Query('/ppp/secret/add'))
            ->equal('name', $request->name)
            ->equal('password', $request->password)
            ->equal('service', $request->service)
            ->equal('profile', $request->profile)
            ->equal('local-address', $request->local_address)
            ->equal('remote-address', $request->remote_address);

        $client->query($addSecret)->read();

            return redirect()->route('pppoe.client')->with('success', 'Client berhasil ditambahkan!');
            } catch (\Exception $e) {
            return redirect()->route('pppoe.client')->with('error', 'Gagal menambahkan client: ' . $e->getMessage());
        }
    }
        public function simpanClient(Request $request)
    {
        $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
        ]);


        // Hapus user lama (dengan nama yg sama)
        $deleteQuery = (new Query('/ppp/secret/remove'))
            ->equal('.id', $this->getSecretIdByName($client, $request->name));
        $client->query($deleteQuery)->read();

        // Tambahkan ulang dengan data baru
        $addSecret = (new Query('/ppp/secret/add'))
            ->equal('name', $request->name)
            ->equal('password', $request->password)
            ->equal('service', $request->service)
            ->equal('profile', $request->profile)
            ->equal('local-address', $request->local_address)
            ->equal('remote-address', $request->remote_address);

        $client->query($addSecret)->read();

        return redirect()->back()->with('success', 'Client PPPoE berhasil diperbarui!');
    }

    private function getSecretIdByName($client, $name)
    {
        $query = (new Query('/ppp/secret/print'))->where('name', $name);
        $result = $client->query($query)->read();

        return $result[0]['.id'] ?? null;
    }

        public function storeProfile(Request $request)
    {
        $client = new Client([
            'host' => session('mikrotik_ip'),
            'user' => session('mikrotik_user'),
            'pass' => session('mikrotik_pass'),
        ]);


        $addProfile = new Query('/ppp/profile/add');
        $addProfile->equal('name', $request->name);
        $addProfile->equal('local-address', $request->local_address);
        $addProfile->equal('remote-address', $request->remote_address);
        $addProfile->equal('rate-limit', $request->rate_limit);
        $addProfile->equal('only-one', $request->only_one);

        $client->query($addProfile)->read();

        return redirect()->back()->with('success', 'Profil PPPoE berhasil ditambahkan');
    }

}

