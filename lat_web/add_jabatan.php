<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $iddep = $_POST['iddep'];
    $jabatan = $_POST['jabatan'];

    $stmt = $conn->prepare("INSERT INTO jabatan (id_jabatan, nama_jabatan) VALUES (?,?)");
    $stmt->bind_param("ss",$iddep,$jabatan);

    if($stmt->execute()){
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen berhasil ditambah.'];
    }else{
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen gagal ditambah.'];
    }
    $stmt->close();
    header("Location: jabatan.php");
    exit();
}else{
    header("Location: jabatan.php");
    exit();
}
?>