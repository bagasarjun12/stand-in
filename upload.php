<?php
session_start();
//cek apakah user sudah login 
if(!isset($_SESSION["Login"])){
    header('Location:login.php');
}

include 'koneksi.php';
$q = 'select * from user';
$result = mysqli_query($conn, $q);

//memanggil method fungsi
require 'fungsi.php';

//cek apakah tombol submit telah di klik atau belum
if( isset($_POST["submit"]) ){
    tambah($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/index.css" type="text/css">
    <title>Stand.in | Homepage
    </title>
    
    <style>
        .title-upload{
            margin-top: 50px;
            font-size: 40px;
        }
        .form-upload{
            margin-left: auto;
            margin-right: auto;
            width: 60%;
        }
        .form-border{
            width: 100%;
            background-color: #f2f2f2;
        }
        textarea {
            width: 100%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            resize: none;
        }

        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

        input[type=submit]:hover {
            background-color: #45a049;
            }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            }

        form .input-harga{
            display: inline;
            width: 40%;
        }

        form .input-ukuran{
            text-align: center;
            padding: 12px 20px;
            margin: 8px 10px 8px 5px;
            display: inline;
            width: 13%;
        }

        form .block{
            display:block;
        }

        input:out-of-range {
        border:2px solid red;
        }

        form .gambar-upload{
            margin-top: 20px;
            position: absolute;
            width:250px;
            height:250px;
            border-radius:5%;
        }

        form .file{
            margin-left:250px;
            margin-bottom:180px;
        }
        
        form .upload-gambar{
            font-size: 16px;
            background:black;
            border-radius: 50px;
            box-shadow: 5px 5px 10px black;
            width: 350px;
            outline: none;
            color: white;
        }

        ::-webkit-file-upload-button{
            color: white;
            background: 20px;
            padding: 20px;
            border: none;
            border-radius: 50px;
            box-shadow: 1px 0 1px 1px yellow;
            outline:none;
        }

        ::-webkit-file-upload-button:hover{
            cursor: pointer;
            background: rgb(59, 59, 59);
        }


    </style>
</head>

<body>
    <div class="header">
        <nav>
            <h4>Standin</h4>
            <ul class="nav-links">
                <li><a href="">About</a></li>
                <li><a href="">Contacts</a></li>
                <li class="btn"><a href="upload.php">Upload</a></li>
                <li class="btn"><a href="kelola.php">Kelola</a></li>
            </ul>
        </nav>
        <div class="title-upload">
            <h2>Upload Stand</h2>
        </div>
        <div class= "form-border">
        <div class= "form-upload">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 class="block">Pilih Gambar</h2>
            <img src="public/img/foto_stand.jpg" class="gambar-upload" name="gambar" id="gambar" onclick="klikfile()" border="3"></img> <br>
            <div class="file">
            <input type="file" class="upload-gambar" name='file' onchange="tampilkanGambar(this)" id="file"></div>            
            <h2>Judul</h2>
            <input type="text" id="judul" name="judul" placeholder="Judul iklan" maxlength="50" required>
            <h2>Deskripsi</h2>
            <p><strong>Tip:</strong> Deskripsikan Informasi Stand Anda Disini <b>( Maksimal: 200 kata )<b> </p>           
            <textarea maxlength="200" name = "deskripsi"></textarea>
            <h2>Bahan Stand</h2>
            <select id="bahan" name="bahan" required>
            <option value=""></option>
            <?php 

                $readuser = "select * from bahan_stand";
                $q = mysqli_query($conn, $readuser);

                while ($bahan = mysqli_fetch_array($q)) {
                    ?>
                    <option value="<?php echo $bahan['ID_BAHAN']; ?>" > <?php echo $bahan['NAMA_BAHAN']; ?></option>
                    <?php
                }
            ?>
            </select>
            <h2>Jenis Stand</h2>
            <select id="jenis" name="jenis" required>
            <option value=""></option>
            <?php 

                $readuser = "select * from jenis_stand";
                $q = mysqli_query($conn, $readuser);

                while ($bahan = mysqli_fetch_array($q)) {
                    ?>
                    <option value="<?php echo $bahan['ID_JENIS']; ?>" > <?php echo $bahan['NAMA_JENIS']; ?></option>
                    <?php
                }
            ?>
            </select>
            <h2 class="block">Ukuran</h2>
            <p><strong>Contoh: </strong>3 x 3 Meter </p>
            <input type="text" class="input-ukuran" id="ukuran1" name="ukuran1" maxlength="4" onkeypress="return inputangka(event)" required>
            <label> X </label>
            <input type="text" class="input-ukuran" id="ukuran2" name="ukuran2" maxlength="4" onkeypress="return inputangka(event)" required>
            <label> Meter </label>
            <h2 class="block">Alamat</h2>
            <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap stand" maxlength="50" required>
            <h2>Kota</h2>
            <select id="kota" name="kota" required>
            <option value=""></option>
            <?php 
                $readuser = "select * from kota";
                $q = mysqli_query($conn, $readuser);

                while ($kota = mysqli_fetch_array($q)) {
                    ?>
                    <option value="<?php echo $kota['nama_kota']; ?>" > <?php echo $kota['nama_kota']; ?></option>
                    <?php
                }
            ?>
            </select>
            <h2>Harga Sewa </h2>
            <label>Rp. </label>
            <input type="text" class="input-harga" id="harga" name="harga" maxlength="11" onkeypress="return inputangka(event)" required>
            <label> / Bulan </label>
            <input type="submit" name="submit" value="Upload Stand">
            
        </form>
        </div>
        </div>
    </div>
</body>
<script src="public/js/myscript.js"></script>
</html>

