<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class log_controller extends Controller
{
    public function index()
    {
        $logs = DB::table('semua_log')
            ->where(function($query) {
                $query->where('topics', 'like', '%pppoe%')
                    ->orWhere('message', 'like', '%authentication failed%')
                    ->orWhere('message', 'like', '%disconnected%')
                    ->orWhere('message', 'like', '%timeout%');
            })
            ->orderBy('time', 'desc')
            ->get();

        return view('pppoe.log', compact('logs'));
    }
    public function delete($id)
    {
        DB::table('semua_log')->where('id', $id)->delete();
        return back()->with('success', 'Log berhasil dihapus');
    }
    public function bulkDelete(Request $request)
    {
        if ($request->has('log_ids')) {
            DB::table('semua_log')->whereIn('id', $request->log_ids)->delete();
        }
        return back()->with('success', 'Log terpilih berhasil dihapus');
    }
    public function download()
    {
        $logs = DB::table('semua_log')
            ->where(function($query) {
                $query->where('topics', 'like', '%pppoe%')
                    ->orWhere('message', 'like', '%authentication failed%')
                    ->orWhere('message', 'like', '%disconnected%')
                    ->orWhere('message', 'like', '%timeout%');
            })
            ->orderBy('time', 'desc')
            ->get();

        $pdf = Pdf::loadView('pppoe.log_pdf', compact('logs'));
        return $pdf->download('pppoe-log.pdf');
    }
}
?>
