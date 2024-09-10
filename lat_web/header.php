<?php
session_start();
// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
// Mendapatkan informasi pengguna
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi HRD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .header, .footer {
            width: calc(100% - 250px); /* Lebar mengikuti lebar konten dengan sidebar */
            margin-left: 250px;
            padding: 15px;
        }
        .header {
            background-color: #007bff;
            color: white;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            padding: 15px;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar .user-info {
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar .user-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }
        .sidebar .user-info p {
            margin: 10px 0;
            color: white;
            font-weight: bold;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #007bff;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 15px;
            flex: 1;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .card {
            margin-bottom: 20px;
        }
        .nav-link .submenu {
            display: none;
            padding-left: 20px;
        }
        .nav-link.active .submenu {
            display: block;
        }
    </style>
</head>
<body> 
    <div class="header">
        <h3>Aplikasi HRD</h3>
    </div>
</body>