<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengangkutan</title>
    <link rel="stylesheet" href="hmpage_collect.css">
</head>
<body>
    <div class="home-container pickup-container">
        <div class="header-bar">
            <a href="#" onclick="history.back();" class="back-arrow">&#8592;</a>
            <div class="home-logo">
                <img src="img/logo pilastik.png" alt="PILASTIK Logo">
            </div>
        </div>

        <h1 class="page-title">Informasi Pengangkutan</h1>

        <div class="map-container card-style">
            <iframe
                src="https://www.openstreetmap.org/export/embed.html?bbox=106.77535057067871%2C-6.661879532501472%2C106.85131072998048%2C-6.606633675940122&amp;layer=mapnik"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
                class="embedded-map"
            ></iframe>
            <small class="map-attribution">
                <a href="https://www.openstreetmap.org/?#map=14/-6.63426/106.81333" target="_blank">Lihat Peta Lebih Besar</a>
                | &copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">Kontributor OpenStreetMap</a>
            </small>
        </div>

        <div class="data-pengangkutan card-style">
            <h2>Data Pengangkutan</h2>
            <table>
                <tr>
                    <td>Tempat Sampah Yang Perlu di Angkut</td>
                    <td>:</td>
                    <td>htmlspecialchars($tempat_sampah)</td>
                </tr>
                <tr>
                    <td>Info Kendaraan Yang Tersedia</td>
                    <td>:</td>
                    <td>htmlspecialchars($info_kendaraan)</td>
                </tr>
                <tr>
                    <td>Hari Pengangkutan</td>
                    <td>:</td>
                    <td>htmlspecialchars($hari_pengangkutan)</td>
                </tr>
                <tr>
                    <td>Nama Kolektor</td>
                    <td>:</td>
                    <td>htmlspecialchars($nama_kolektor)</td>
                </tr>
            </table>
        </div>

        <div class="play-button-container">
            <a href="mulai.php" class="play-button">
                <svg viewBox="0 0 24 24" width="80" height="80" fill="#fff">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </a>
        </div>

        <div class="footer-text">
            &copy; Universitas Pakuan Bogor 2025
        </div>
    </div>
</body>
</html>