<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Sampah</title>
</head>
<body>
    <h2>Pelaporan Tempat Sampah Masyarakat {{ now()->translatedFormat('d F Y') }}</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Tempat Sampah</th>
                <th>Tipe</th>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Kapasitas (L)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trashBins as $index => $bin)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ 'TS' . str_pad($bin->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ ucfirst($bin->bin_type) }}</td>
                <td>{{ $bin->resident->name }}</td>
                <td>{{ $bin->resident->address }}</td>
                <td>{{ $bin->capacity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>