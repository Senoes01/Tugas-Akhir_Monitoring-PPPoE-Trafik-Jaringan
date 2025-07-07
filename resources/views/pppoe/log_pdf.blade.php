<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log PPPoE</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 6px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Gangguan PPPoE</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pesan</th>
                <th>Waktu & Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->message }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->time)->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
