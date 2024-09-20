<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $id = $_POST['id'];
    $departemen = $_POST['id_departemen'];
    $jabatan = $_POST['id_jabatan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    $target_dir = "C:/xampp/htdocs/Kepegawaian-PHP/lat_web/img/";
    $file ="img/". basename($_FILES["foto"]["name"]);
    $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["foto"]["tmp_name"], $file);
    $file = "\"" . $file . "\"";


    $stmt = $conn->prepare("INSERT INTO pegawai (id_pegawai, id_departemen, id_jabatan,  nama_pegawai, alamat, no_telepon, email, foto_pegawai) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiisssss",$id, $departemen, $jabatan, $nama, $alamat, $telp, $email, $file);

    if($stmt->execute()){
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen berhasil ditambah.'];
    }else{
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen gagal ditambah.'];
    }
    $stmt->close();
    header("Location: pegawai.php");
    exit();
}else{
    header("Location: pegawai.php");
    exit();
}
?>