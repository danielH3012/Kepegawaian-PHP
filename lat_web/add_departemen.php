<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $iddep = $_POST['iddep'];
    $departemen = $_POST['departemen'];

    $stmt = $conn->prepare("INSERT INTO departemen (id_departemen, nama_departemen) VALUES (?,?)");
    $stmt->bind_param("ss",$iddep,$departemen);

    if($stmt->execute()){
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen berhasil ditambah.'];
    }else{
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen gagal ditambah.'];
    }
    $stmt->close();
    header("Location: departemen.php");
    exit();
}else{
    header("Location: departemen.php");
    exit();
}
?>