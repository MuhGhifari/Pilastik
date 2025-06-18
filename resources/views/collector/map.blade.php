<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Sampah - Pilastik</title>
    <link rel="stylesheet" href="hmpage_collect.css">
    <style>
        /* Container utama halaman peta */
        .map-page-container {
            background-color: rgba(255, 255, 255, 0.9);
            margin: 50px auto;
            padding: 20px;
            border-radius: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 90%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Judul halaman peta */
        .map-page-title {
            text-align: center;
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 15px 0;
        }

        /* Tombol kembali */
        .back-arrow {
            color: #555;
            font-size: 30px;
            margin-left: 5px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        /* Gaya untuk iframe peta */
        .embedded-osm-map {
            width: 100%;
            height: 350px;
            border: 1px solid #ccc;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        /* Link atribusi peta */
        .map-attribution-link {
            text-align: right;
            font-size: 12px;
            margin-top: 5px;
            color: #666;
            text-decoration: none;
        }

        .map-attribution-link a {
            color: #666;
            text-decoration: none;
        }

        .map-attribution-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="map-page-container">
        <header class="header-bar">
            <a href="hmpage_collect.php" class="back-arrow">&#8592;</a>
            <div class="home-logo">
                <img src="{{ asset('images/logo pilastik.png') }}" alt="Logo PILASTIK">
            </div>
        </header>

        <h1 class="map-page-title">Peta Lokasi Sampah</h1>

        <iframe class="embedded-osm-map" src="https://www.openstreetmap.org/export/embed.html?bbox=106.77535057067871%2C-6.661879532501472%2C106.85131072998048%2C-6.606633675940122&amp;layer=mapnik" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        <div class="map-attribution-link">
            <small><a href="https://www.openstreetmap.org/?#map=14/-6.63426/106.81333" target="_blank">Lihat Peta Lebih Besar</a></small>
        </div>

        <div class="card-style">
            <p>Peta ini menunjukkan area umum lokasi pengumpulan sampah di sekitar Bogor.</p>
            <p>Untuk informasi lebih detail mengenai titik-titik sampah, harap hubungi administrator.</p>
        </div>
    </div>

</body>
</html>