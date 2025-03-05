<?php
// Cek apakah data sudah dikirim via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data input dari form
    $beratBadan = isset($_POST['beratBadan']) ? floatval($_POST['beratBadan']) : 0;
    $tinggiBadan = isset($_POST['tinggiBadan']) ? floatval($_POST['tinggiBadan']) : 0;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Hitung IMT: Berat badan (kg) / (Tinggi badan (m) ^ 2)
    if ($tinggiBadan > 0) {
        $imt = $beratBadan / ($tinggiBadan * $tinggiBadan);
    } else {
        $imt = 0;
    }

    // Klasifikasi IMT
    if ($imt < 16) {
        $klasifikasi = 'Sangat kurus';
    } elseif ($imt >= 16 && $imt < 17) {
        $klasifikasi = 'Kurus';
    } elseif ($imt >= 17 && $imt < 18.5) {
        $klasifikasi = 'Cukup kurus';
    } elseif ($imt >= 18.5 && $imt < 25) {
        $klasifikasi = 'Normal';
    } elseif ($imt >= 25 && $imt < 30) {
        $klasifikasi = 'Kelebihan berat badan';
    } elseif ($imt >= 30 && $imt < 35) {
        $klasifikasi = 'Obesitas tingkat 1';
    } elseif ($imt >= 35 && $imt < 40) {
        $klasifikasi = 'Obesitas tingkat 2';
    } else {
        $klasifikasi = 'Obesitas tingkat 3';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung IMT</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background image */
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.png'); /* Ganti dengan gambar yang Anda inginkan */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Efek Glassmorphism untuk container form */
        .container {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparan */
            border-radius: 15px;
            backdrop-filter: blur(10px); /* Efek blur */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #fff;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1em;
            color: #fff;
            display: block;
            margin-bottom: 8px;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 6px;
            font-size: 1.2em;
            color: #fff;
        }

        /* Menambahkan efek border pada form input */
        .form-control {
            border-radius: 6px;
        }

        /* Menambahkan padding pada tombol */
        .btn {
            padding: 15px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Hitung Indeks Massa Tubuh (IMT)</h1>
        
        <!-- Form untuk input -->
        <form method="POST">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="beratBadan" class="form-label">Berat Badan (kg): </label>
                    <input type="number" name="beratBadan" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="tinggiBadan" class="form-label">Tinggi Badan (m): </label>
                    <input type="number" step="0.01" name="tinggiBadan" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="gender" class="form-label">Gender: </label>
                    <select name="gender" class="form-select" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-4">Hitung IMT</button>
        </form>

        <?php
        // Menampilkan hasil perhitungan jika sudah ada
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<div class='result'>";
            echo "<h2>Hasil IMT: " . round($imt, 2) . "</h2>";
            echo "<h3>Klasifikasi: " . $klasifikasi . "</h3>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Menyertakan Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
