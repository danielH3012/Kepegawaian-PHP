<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $iddep = $_POST['iddep'];
    $departemen = $_POST['departemen'];

    $stmt = $conn->prepare("UPDATE INTO departemen SET departemen = ? WHERE iddep = ?");
    $stmt->bind_param("ss",$iddep,$departemen);

    if($stmt->execute()){
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen berhasil diperbaharui.'];
    }else{
        $_SESSION['massage'] = ['type'=> 'success', 'text'=>'Data departemen gagal diperbaharui.'];
    }
    $stmt->close();
    header("Location: departemen.php");
    exit();
}else{
    header("Location: departemen.php");
    exit();
}
?>