<?php
include 'db_config.php'; 


$user_name = "Rina"; 
$user_id = "#92834";
$user_phone = "+62 8xxx xxxx xxxx";
$user_address = "Lebak Pilor Rt 02/04, Desa Bendungan, Kota Bogor";
$waste_type = "Organik"; 
$berat_sampah = "";
$catatan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $berat_sampah = htmlspecialchars($_POST['berat_sampah']);
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $catatan = htmlspecialchars($_POST['catatan']);

    echo "<script>alert('Penilaian berhasil disubmit! Berat: " . $berat_sampah . " kg, Rating: " . $rating . " bintang, Catatan: " . $catatan . "');</script>";
}

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Sampah</title>
    <link rel="stylesheet" href="hmpage_collect.css">
    </head>
<body>
    <div class="home-container penilaian-container">
        <div class="header-bar">
            <a href="#" onclick="history.back();" class="back-arrow">&#8592;</a>
            <div class="home-logo">
                <img src="img/logo pilastik.png" alt="PILASTIK Logo">
            </div>
        </div>

        <h1 class="page-title">Penilaian Sampah</h1>

        <div class="user-info-card card-style">
            <div class="user-profile">
                <img src="img/profile.png" alt="Rina's Profile" class="profile-pic">
                <div class="user-details">
                    <h3><?php echo htmlspecialchars($user_name); ?></h3>
                    <p>ID <?php echo htmlspecialchars($user_id); ?></p>
                    <p><img src="img/phone_icon.png" alt="Phone" class="icon"> <?php echo htmlspecialchars($user_phone); ?></p>
                    <p><img src="img/location_icon.png" alt="Location" class="icon"> <?php echo htmlspecialchars($user_address); ?></p>
                </div>
            </div>
            <span class="waste-tag <?php echo strtolower($waste_type); ?>"><?php echo htmlspecialchars($waste_type); ?></span>
        </div>

        <form action="mulai.php" method="POST" class="penilaian-form">
            <label for="berat_sampah">Berat Sampah</label>
            <div class="input-group">
                <input type="number" id="berat_sampah" name="berat_sampah" placeholder="Tuliskan berat sampah Anda di sini..." step="0.1" required>
                <span>kg</span>
            </div>

            <label>Nilai untuk hasil pemilahan sampah</label>
            <div class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5" required><label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
            </div>

            <label for="catatan">Catatan</label>
            <textarea id="catatan" name="catatan" rows="5" placeholder="Tuliskan catatan Anda di sini..."></textarea>

            <button type="submit" class="submit-button">Submit</button>
        </form>

        <div class="footer-text">
            &copy; Universitas Pakuan Bogor 2025
        </div>
    </div>
</body>
</html>