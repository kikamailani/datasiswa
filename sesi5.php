<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Siswa</title>
    <style>
        /* Tambahkan gaya CSS*/
        body {
            font-family: Arial, sans-serif;
            background-color: #e6687e;
        }
        h1 {
            text-align: center;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>MASUKAN DATA</h1>
    <form method="POST" action="">
        <table>
            <tr>
                <td><label for="nama">NAMA:</label></td>
                <td><input type="text" name="nama" id="nama"></td>
            </tr>
            <tr>
                <td><label for="nis">NIS:</label></td>
                <td><input type="text" name="nis" id="nis"></td>
            </tr>
            <tr>
                <td><label for="rayon">RAYON:</label></td>
                <td><input type="text" name="rayon" id="rayon"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="kirim">Kirim</button>
                    <button type="submit" name="reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Memulai sesi
    session_start();

    // Menghapus sesi
    if(isset($_POST['reset'])){
        session_unset();
    }

    // Proses tombol hapus pada table tampil data
    if(isset($_GET['hapus'])) {
        $index = $_GET['hapus'];
        unset($_SESSION['dataSiswa'][$index]);
    }

    // Membuat data array multidimensi jika belum ada
    if(!isset($_SESSION['dataSiswa'])){
        $_SESSION['dataSiswa'] = array();
    }

    // Menambahkan data jika form disubmit
    if(isset($_POST['kirim'])) {
        if(isset($_POST['nama']) && isset($_POST['nis']) && isset($_POST['rayon'])) {
            $data = [
                'nama' => $_POST['nama'],
                'nis' => $_POST['nis'],
                'rayon' => $_POST['rayon'],
            ];
            array_push($_SESSION['dataSiswa'], $data);
        }
    }

    // Menampilkan data menggunakan table
    if(!empty($_SESSION['dataSiswa'])) {
        echo '<table>';
        echo '<tr>';
        echo '<th>NAMA</th>';
        echo '<th>NIS</th>';
        echo '<th>RAYON</th>';
        echo '<th>AKSI</th>';
        echo '</tr>';

        // Menampilkan data siswa
        foreach($_SESSION['dataSiswa'] as $index => $value){
            echo '<tr>';
            echo '<td>'. $value['nama']. '</td>';
            echo '<td>'. $value['nis']. '</td>';
            echo '<td>'. $value['rayon']. '</td>';
            echo '<td><a href="?hapus='. $index .'">HAPUS</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p style="text-align:center;">Data Belum Muncul ☹!!!</p>';
    }
    ?>
</body>
</html>
