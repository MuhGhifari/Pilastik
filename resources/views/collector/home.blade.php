@extends('layouts.app')

@section('styles')
<style>
	
@font-face {
    font-family: 'Coolvetica'; /* Nama font family yang konsisten */
    src: url('fonts/Coolvetica Rg.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Coolvetica';
    src: url('fonts/Coolvetica Hv Comp.otf') format('opentype');
    font-weight: bold;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Coolvetica';
    src: url('fonts/Coolvetica Rg It.otf') format('opentype');
    font-weight: normal;
    font-style: italic;
    font-display: swap;
}

@font-face {
    font-family: 'Coolvetica';
    src: url('fonts/Coolvetica Rg Cond.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'Coolvetica';
    src: url('fonts/Coolvetica Rg Cram.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Coolvetica Regular';
    background-size: cover;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}

.home-container {
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

.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 0;
}

.back-arrow {
    color: #555;
    font-size: 30px;
    margin-left: 5px;
    text-decoration: none;
}

.home-logo img {
    width: 60px;
    height: auto;
}

.page-title {
    text-align: center;
    color: #333;
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

/* --- untuk Kartu menjadi Tombol --- */
.card-link {
    background-color: #004d26; 
    border-radius: 15px;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: block;
    text-decoration: none;
    color: white;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-link:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
}

.card-link:active {
    transform: translateY(0px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    transition: transform 0.1s ease, box-shadow 0.1s ease;
}

.card-link img {
    width: calc(100% - 20px);
    height: 300px;
    object-fit: cover;
    display: block;
    margin: 10px;
    border-radius: 5%;
}

.card-label {
    background-color: #004d26; 
    color: white;
    font-weight: bold;
    padding: 12px;
    font-size: 16px;
    text-align: center;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}


/*  (Untuk semua kartu seperti peta, data pengangkutan, info user) */
/* ========================================================================== */
.card-style {
    background-color: #71967f;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 5px;
    overflow: hidden;
    padding: 15px;
}



/*(pengankutan_collect.php) */
/* ========================================================================== */
.pickup-container .page-title {
    margin-bottom: 20px;
}

.map-container {
    text-align: center;
}

.embedded-map {
    border-radius: 10px;
    display: block;
    height: 200px;
    width: 100%;
}

.map-attribution {
    color: #000000;
    display: block;
    font-family: 'Segoe UI', sans-serif;
    font-size: 10px;
    margin-top: 5px;
    text-align: right;
}

.map-attribution a {
    color: #000000;
    text-decoration: none;
}

.map-attribution a:hover {
    text-decoration: underline;
}

.data-pengangkutan h2 {
    color: #000000; 
    font-size: 18px;
    margin-bottom: 15px;
    margin-top: 0;
    text-align: center;
}

.data-pengangkutan table {
    border-collapse: collapse;
    width: 100%;
}

.data-pengangkutan table td {
    color: #333;
    font-size: 15px;
    padding: 8px 0;
}

.data-pengangkutan table td:first-child {
    width: 60%;
}

.data-pengangkutan table td:nth-child(2) {
    text-align: center;
    width: 5%;
}

.data-pengangkutan table td:last-child {
    color: #222;
    font-weight: bold;
}

.play-button-container {
    margin: 30px 0;
    text-align: center;
}

.play-button {
    align-items: center;
    background: linear-gradient(to bottom, #004d26, #00331a); 
    border: none;
    border-radius: 50%;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    display: inline-flex;
    height: 100px;
    justify-content: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 100px;
}

.play-button:hover {
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
    transform: scale(1.05);
}

.play-button:active {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transform: scale(0.98);
}

.play-button svg {
    fill: white;
    height: 50px;
    margin-left: 5px;
    width: 50px;
}



/*(mulai.php) */
/* ========================================================================== */

.penilaian-container {
    gap: 10px;
}

.penilaian-container .header-bar {
    padding-bottom: 0px;
    margin-bottom: 0px;
}

.penilaian-container .page-title {
    margin-top: 0;
    margin-bottom: 15px;
}

/* BAGIAN PROFILE */
.user-info-card {
    background-color: #71967f; 
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 15px;
    position: relative;
    margin-bottom: 20px;
    width: auto;
}

.user-profile {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    width: 100%;
}

.profile-pic {
    border: 2px solid #87a96b; 
    border-radius: 50%;
    height: 80px;
    margin-right: 15px;
    object-fit: cover;
    width: 80px;
}

.user-details {
    flex-grow: 1;
}

.user-details h3 {
    color: #4a6c4c; 
    font-size: 18px;
    margin: 0 0 5px 0;
}

.user-details p {
    align-items: center;
    color: #555;
    display: flex;
    font-size: 14px;
    margin: 3px 0;
}

.user-details .icon {
    filter: invert(30%) sepia(10%) saturate(1000%) hue-rotate(80deg) brightness(80%) contrast(80%);
    height: 16px;
    margin-right: 5px;
    vertical-align: middle;
    width: 16px;
}

.waste-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #87a96b;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.waste-tag.organik {
    background-color: #87a96b; 
}
.waste-tag.anorganik {
    background-color: #e6b800;
}


/* Form Penilaian */
.penilaian-form {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.penilaian-form label {
    color: #333;
    font-weight: bold;
    margin-bottom: 8px;
    margin-top: 15px;
    font-size: 15px;
}

.input-group {
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 8px;
    display: flex;
    margin-bottom: 15px;
    overflow: hidden;
}

.input-group input[type="number"] {
    background-color: #f9f9f9;
    border: none;
    color: #333;
    flex-grow: 1;
    font-size: 16px;
    outline: none;
    padding: 12px 15px;
}

.input-group input[type="number"]::placeholder {
    color: #999;
}

.input-group span {
    background-color: #eee;
    border-left: 1px solid #ccc;
    color: #555;
    font-weight: bold;
    font-size: 16px;
}

/* Rating Stars */
.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    margin-bottom: 20px;
    gap: 5px;
}

.rating-stars input[type="radio"] {
    display: none;
}

.rating-stars label {
    cursor: pointer;
    width: 35px;
    height: 35px;
    background-image: url('img/star-regular.svg');
    background-size: cover;
    transition: background-image 0.2s ease;
    margin-top: 0;
    margin-bottom: 0;
}

.rating-stars input[type="radio"]:checked ~ label,
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    background-image: url('img/bintang.svg');
}

/* Textarea Catatan */
textarea {
    border: 1px solid #ccc;
    border-radius: 8px;
    font-family: 'Coolvetica', sans-serif;
    font-size: 15px;
    margin-bottom: 20px;
    min-height: 100px;
    outline: none;
    padding: 15px;
    resize: vertical;
    width: calc(100% - 30px);
}

textarea::placeholder {
    color: #999;
}

.submit-button {
    background: linear-gradient(to bottom, #004d26, #00331a); 
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    color: white;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    padding: 15px 25px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 100%;
}

.submit-button:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.submit-button:active {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transform: translateY(0);
}



/* FOOTER STYLES */
/* ========================================================================== */
.footer-text {
    color: #777;
    font-family: 'Segoe UI', sans-serif;
    font-size: 12px;
    margin-top: 30px;
    padding-bottom: 10px;
    text-align: center;
}



/* RESPONSIVE STYLES (MOBILE) */
/* ========================================================================== */
@media screen and (max-width: 480px) {
    .home-container {
        margin: 20px auto;
        padding: 15px;
        max-width: 90%;
    }

    .home-logo img {
        width: 60px;
    }

    /* Pickup Info Page */
    .pickup-container .page-title {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .card-style {
        padding: 12px;
    }

    .embedded-map {
        height: 180px;
    }

    .data-pengangkutan table td {
        font-size: 14px;
        padding: 6px 0;
    }

    .play-button {
        width: 80px;
        height: 80px;
    }

    .play-button svg {
        width: 40px;
        height: 40px;
    }

    /* Penilaian Sampah Page */
    .penilaian-container .page-title {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .user-info-card {
        padding: 12px;
    }

    .profile-pic {
        width: 70px;
        height: 70px;
    }

    .user-details h3 {
        font-size: 16px;
    }

    .user-details p {
        font-size: 13px;
    }

    .user-details .icon {
        width: 14px;
        height: 14px;
    }

    .waste-tag {
        font-size: 11px;
        padding: 4px 10px;
    }

    .penilaian-form label {
        font-size: 14px;
    }

    .input-group input[type="number"],
    .input-group span {
        padding: 10px 12px;
        font-size: 15px;
    }

    .rating-stars label {
        width: 30px;
        height: 30px;
    }

    textarea {
        padding: 12px;
        font-size: 14px;
        min-height: 80px;
    }

    .submit-button {
        padding: 12px 20px;
        font-size: 16px;
    }

    .footer-text {
        font-size: 11px;
        margin-top: 20px;
    }
}
</style>
@endsection

@section('content')
	<div class="home-container">
    <header class="home-header"> <div class="home-logo">
            <img src="{{asset('images/logo pilastik.png')}}" alt="Logo PILASTIK">
        </div>
    </header>

    <a href="{{route('collector.collection_run')}}" class="card-link"> <img src="{{ asset('images/angkut.jpeg')}}" alt="Mulai Mengangkut">
      <div class="card-label">Mulai Mengangkut</div> </a>`

    <a href="{{route('collector.map')}}" class="card-link"> <img src="{{ asset('images/map.png')}}" alt="Peta Sampah">
      <div class="card-label">Peta Sampah</div> </a>

  </div>
@endsection