<?php

class NilaiMapel
{
    private $Nis;
    private $Nama;
    private $Matematika;
    private $Produktif;
    private $Pipas;
    private $Bindo;
    private $Eskul;
    private $Senbud;

    // Umumnya constructor dibuat untuk memberikan suatu operasi awal yang harus dilakukan ketika sebuah objek dilahirkan (inisialisasi objek).
    public function __construct($Nis, $Nama, $Matematika, $Produktif, $Pipas, $Bindo, $Eskul, $Senbud)
    {
        $this->Nis = $Nis;
        $this->Nama = $Nama;
        $this->Matematika = $Matematika;
        $this->Produktif = $Produktif;
        $this->Pipas = $Pipas;
        $this->Bindo = $Bindo;
        $this->Eskul = $Eskul;
        $this->Senbud = $Senbud;
    }

    public function hitungTotal()
    {
        return $this->Matematika + $this->Produktif + $this->Pipas + $this->Bindo + $this->Eskul + $this->Senbud;
    }

    public function hitungRataRata()
    {
        return $this->hitungTotal() / 6;
    }

    public function hitungNilaiMax()
    {
        return max($this->Matematika, $this->Produktif, $this->Pipas, $this->Bindo, $this->Eskul, $this->Senbud);
    }

    public function hitungNilaiMin()
    {
        return min($this->Matematika, $this->Produktif, $this->Pipas, $this->Bindo, $this->Eskul, $this->Senbud);
    }

    public function hitungGrade()
    {
        $rata_rata = $this->hitungRataRata();
        if ($rata_rata >= 90) {
            return "A";
        } elseif ($rata_rata >= 80) {
            return "B";
        } elseif ($rata_rata >= 70) {
            return "C";
        } elseif ($rata_rata >= 60) {
            return "D";
        } else {
            return "E";
        }
    }

    public function simpanData()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $rata_rata = $this->hitungRataRata();
        $rata_rata = number_format($rata_rata, 2);

        $sql = "INSERT INTO data_nilai (nis, nama, matematika, produktif, pipas, bindo, eskul, senbud, rata_rata)
                VALUES ('$this->Nis', '$this->Nama', '$this->Matematika', '$this->Produktif', '$this->Pipas', '$this->Bindo', '$this->Eskul', '$this->Senbud', '$rata_rata')";

        if ($conn->query($sql) === TRUE) {
            echo "Data nilai berhasil disimpan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    public function tampilkanHasilPerhitungan()
    {
        $total = $this->hitungTotal();
        $rata_rata = $this->hitungRataRata();
        $nilai_max = $this->hitungNilaiMax();
        $nilai_min = $this->hitungNilaiMin();
        $grade = $this->hitungGrade();

        echo "<br><h2>Hasil Perhitungan:</h2><hr>";
        echo "Nis Siswa: " . $this->Nis . "<br>";
        echo "Nama Siswa: " . $this->Nama . "<br>";
        echo "Jumlah Total Nilai: " . $total . "<br>";
        echo "Rata-rata Nilai: " . $rata_rata . "<br>";
        echo "Nilai Maksimal: " . $nilai_max . "<br>";
        echo "Nilai Minimal: " . $nilai_min . "<br>";
        echo "Grade Penilaian: " . $grade . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nis = $_POST["nis"];
    $Nama = $_POST["nama"];
    $Matematika = $_POST["nilai1"];
    $Produktif = $_POST["nilai2"];
    $Pipas = $_POST["nilai3"];
    $Bindo = $_POST["nilai4"];
    $Eskul = $_POST["nilai5"];
    $Senbud = $_POST["nilai6"];

    $nilaiMapel = new NilaiMapel($Nis, $Nama, $Matematika, $Produktif, $Pipas, $Bindo, $Eskul, $Senbud);
    $nilaiMapel->simpanData();
    $nilaiMapel->tampilkanHasilPerhitungan();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Nilai Mapel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <h1>Hitung Nilai Mapel</h1>
        <hr>
        <form action="" method="post">
            <label for="nis">Nis :</label>
            <input type="number" id="nis" name="nis" required><br>

            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" required><br>

            <label for="nilai1">Matematika :</label>
            <input type="number" id="nilai1" name="nilai1" required><br>

            <label for="nilai2">Produktif :</label>
            <input type="number" id="nilai2" name="nilai2" required><br>

            <label for="nilai3">Pipas :</label>
            <input type="number" id="nilai3" name="nilai3" required><br>

            <label for="nilai4">Bindo :</label>
            <input type="number" id="nilai4" name="nilai4" required><br>

            <label for="nilai5">Eskul :</label>
            <input type="number" id="nilai5" name="nilai5" required><br>

            <label for="nilai6">Senbud :</label>
            <input type="number" id="nilai6" name="nilai6" required><br>

            <input type="submit" value="Submit">
        </form>
    </center>
</body>
</html>
