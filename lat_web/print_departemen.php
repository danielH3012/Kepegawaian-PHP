<?php 
session_start();
require 'config.php';
require 'fpdf/fpdf.php';

if(!isset($_SESSION['iduser'])){
    header("Location: login.php");
    exit();
}

// ambil data dr db
$stmt = $conn->prepare("SELECT nama, alamat from namausaha LIMIT 1");
$stmt->execute();
$stmt->bind_result($namaUsaha, $alamatUsaha);
$stmt->fetch();
$stmt->close();

//ambil data dr tabel dokumen
$result = $conn->query("SELECT * FROM departemen");

//buat PDF
$pdf = new FPDF();
$pdf->AddPage();

//TAMBAHKAN KOP DOKUMEN
$pdf->SetFont('Arial','B', 16);
$pdf->Cell(0,10, $namaUsaha, 0,1, 'C');
$pdf->SetFont('Arial','', 12);
$pdf->Cell(0,10, $alamatUsaha, 0,1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B', 16);
$pdf->Cell(0,10, 'daftar departemen', 0,1, 'L');
$pdf->Ln(2);

//header tabel
$pdf->SetFont('Arial','B', 12);
$pdf->Cell(10,10, 'No', 1,0, 'C');
$pdf->Cell(40,10, 'kode departemen', 1,0, 'C');
$pdf->Cell(140,10, 'departemen', 1,1, 'C');

//data tabel
$pdf->SetFont('Arial','',12);
$no = 1;

while($row = $result->fetch_assoc()){
    $pdf->Cell(10,10, $no++, 1,0, 'C');
    $pdf->Cell(40,10, $row['iddep'], 1,0, 'C');
    $pdf->Cell(140,10, $row['departemen'], 1,1, 'C');
}

//output pdf
$pdf->Output('I', 'daftar_departemen.pdf');
?>