<?php
session_start();
require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $iddep = $_POST['iddep'];

    $stmt = $conn->prepare("DELETE FROM pegawai WHERE id_pegawai = ?");
    $stmt->bind_param("s",$iddep);

    if($stmt->execute()){
        echo "data berhasil dihapus";
    }else{
        echo "data gagal dihapus";
    }
    $stmt->close();

}
?>