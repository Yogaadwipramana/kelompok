<!-- dengan menggunakan aritmatika dan percabangan buatlah form HTML yang digunakan untuk input 6 nilai mapel setelah di submit nilai akan di hitung : 1.jumlah total / 2.rata-rata / 3.nilai maksimal dan minimal / 4.grade penilaian -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <center><h1>Hitung Nilai Mapel</h1><hr>
    <!DOCTYPE html>
<html>
<head>
    </style>

    <form action="" method="post">

        <label for="nis">Nis :</label>
        <input type="number" id="nis" name="nis" required><br>

        <label for="nama">Nama :    </label>
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

        <input type="submit" value="Submit"></center>
    </form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nis = $_POST["nis"];
    $Nama = $_POST["nama"];
    $Matematika = $_POST["nilai1"];
    $Produktif = $_POST["nilai2"];
    $Pipas = $_POST["nilai3"];
    $Bindo = $_POST["nilai4"];
    $Eskul = $_POST["nilai5"];
    $Senbud = $_POST["nilai6"];

    // Membuat koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "latihan_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    // Menyimpan data ke dalam tabel db_mapel
    $sql = "INSERT INTO db_mapel (nis, nama, matematika, produktif, pipas, bindo, eskul, senbud, rata_rata)
            VALUES ('$Nis','$Nama','$Matematika', '$Produktif', '$Pipas', '$Bindo', '$Eskul', '$Senbud', '$rata_rata')";

    if ($conn->query($sql) === TRUE) {
    echo "<script> alert ('Berhasil Berhasil Hore!!!') ;
    </script>";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // $conn->close(); 
    $query = mysqli_query($conn, $sql);
    if($query){
        $sqli = "SELECT * FROM db_mapel";
        $sambungan = mysqli_query($conn, $sqli);
        if(mysqli_num_rows($sambungan) > 0 ) {
            while($tampil = mysqli_fetch_assoc($sambungan)) {

            }
        }
    } 
    ?>
<!-- 
    <tr>
        <td><?php echo $_POST['tampil'];?></td>
    </tr> -->


    
<?php
        // Menghitung total nilai
        $total = $Matematika + $Produktif + $Pipas + $Bindo + $Eskul + $Senbud;

        // Menghitung rata-rata nilai
        $rata_rata = $total / 6;

        // Mencari nilai maksimal
        $nilai_max = max($Matematika, $Produktif, $Pipas, $Bindo, $Eskul, $Senbud);

        // Mencari nilai minimal
        $nilai_min = min($Matematika, $Produktif, $Pipas, $Bindo, $Eskul, $Senbud);

        // Menghitung grade penilaian
        if ($rata_rata >= 90) {
            $grade = "A";
        } elseif ($rata_rata >= 80) {
            $grade = "B";
        } elseif ($rata_rata >= 70) {
            $grade = "C";
        } elseif ($rata_rata >= 60) {
            $grade = "D";
        } else {
            $grade = "E";
        }

        // Menampilkan hasil perhitungan
        echo "<br><h2>Hasil Perhitungan:</h2><hr>";
        echo "Nis Siswa: " . $Nis . "<br>";
        echo "Nama Siswa: " . $Nama . "<br>";
        echo "Jumlah Total Nilai: " . $total . "<br>";
        echo "Rata-rata Nilai: " . $rata_rata . "<br>";
        echo "Nilai Maksimal: " . $nilai_max . "<br>";
        echo "Nilai Minimal: " . $nilai_min . "<br>";
        echo "Grade Penilaian: " . $grade . "<br>";

    }
    
?>


</body>
</html>