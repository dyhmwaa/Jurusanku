<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Konsultasi Jurusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Data Konsultasi Jurusan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nilai</th>
                <th>Mapel Favorit</th>
                <th>Cita-cita</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nilai }}</td>
                <td>{{ $item->mapel_favorit }}</td>
                <td>{{ $item->cita_cita }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
