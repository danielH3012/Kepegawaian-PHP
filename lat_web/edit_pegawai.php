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
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    $file = "\"" . $file . "\"";

    if (file_exists($file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }
      
    if($uploadOk == 1){
        move_uploaded_file($_FILES["foto"]["tmp_name"], $file);
      }
    
    $stmt = $conn->prepare("UPDATE  pegawai SET id_pegawai = ?, id_departemen = ?, id_jabatan = ?,  nama_pegawai = ?, alamat = ?, no_telepon = ?, email = ?, foto_pegawai = ? WHERE id_pegawai = ?" );
    $stmt->bind_param("iiissssss",$id, $departemen, $jabatan, $nama, $alamat, $telp, $email, $file, $id);

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