<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $iddep = $_POST['iddep'];
    $jabatan = $_POST['jabatan'];

    $stmt = $conn->prepare("UPDATE jabatan SET nama_jabatan = ? WHERE id_jabatan = ?");
    $stmt->bind_param("ss",$jabatan,$iddep);

    if($stmt->execute()){
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen berhasil diperbaharui.'];
    }else{
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen gagal diperbaharui.'];
    }
    $stmt->close();
    header("Location: jabatan.php");
    exit();
}else{
    header("Location: jabatan.php");
    exit();
}
?>