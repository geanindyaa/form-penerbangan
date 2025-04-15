<?php
$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

ksort($bandara_asal);
ksort($bandara_tujuan);

$nomor = rand(1000, 9999);
$tanggal = date("Y-m-d");
$nama_maskapai = $asal = $tujuan = $harga_tiket = $pajak = $total_harga = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga_tiket = (int)$_POST['harga'];

    $pajak_asal = isset($bandara_asal[$asal]) ? $bandara_asal[$asal] : 0;
    $pajak_tujuan = isset($bandara_tujuan[$tujuan]) ? $bandara_tujuan[$tujuan] : 0;
    $pajak = $pajak_asal + $pajak_tujuan;

    $total_harga = $harga_tiket + $pajak;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Rute Penerbangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f0;
            color: #4a4a4a;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #f8bbd0;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.2);
        }

        .card-header {
            background-color: #f8bbd0;
            color: #fff;
            font-weight: bold;
        }

        .btn-pink {
            background-color: #ec407a;
            color: white;
        }

        .btn-pink:hover {
            background-color: #d81b60;
        }

        .result-box {
            background-color: #fff0f6;
            border-left: 5px solid #ec407a;
            padding: 15px;
            margin-top: 30px;
            border-radius: 8px;
        }

        h3 {
            color: #c2185b;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    Form Pendaftaran Rute Penerbangan
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="maskapai" class="form-label">Nama Maskapai</label>
                            <input type="text" name="maskapai" id="maskapai" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="asal" class="form-label">Bandara Asal</label>
                            <select name="asal" id="asal" class="form-select" required>
                                <option value="">--Pilih Bandara Asal--</option>
                                <?php foreach ($bandara_asal as $nama => $nilai): ?>
                                    <option value="<?= $nama ?>"><?= $nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Bandara Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select" required>
                                <option value="">--Pilih Bandara Tujuan--</option>
                                <?php foreach ($bandara_tujuan as $nama => $nilai): ?>
                                    <option value="<?= $nama ?>"><?= $nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Tiket (tanpa pajak)</label>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="Proses" class="btn btn-pink">
                        </div>
                    </form>
                </div>
            </div>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="result-box mt-4">
                    <h4>Hasil Pendaftaran</h4>
                    <p><strong>Nomor:</strong> <?= $nomor ?></p>
                    <p><strong>Tanggal Input:</strong> <?= $tanggal ?></p>
                    <p><strong>Nama Maskapai:</strong> <?= $nama_maskapai ?></p>
                    <p><strong>Asal Penerbangan:</strong> <?= $asal ?></p>
                    <p><strong>Tujuan Penerbangan:</strong> <?= $tujuan ?></p>
                    <p><strong>Harga Tiket:</strong> Rp<?= number_format($harga_tiket, 0, ',', '.') ?></p>
                    <p><strong>Pajak:</strong> Rp<?= number_format($pajak, 0, ',', '.') ?></p>
                    <p><strong>Total Harga Tiket:</strong> <span class="text-danger">Rp<?= number_format($total_harga, 0, ',', '.') ?></span></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
