<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        body {
        margin: 0;
        font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100%;
            width: 190px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #323631;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block; /* Menjadikan tautan sebagai blok */
            padding: 10px; /* Menambahkan jarak di sekitar tautan */
        }

        .sidebar ul li a:hover {
            background-color: #45a049;

        }


        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .menu{
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Kantinku</h2>
        <ul>
            <li class="menu"><a href="dashboar_user.php">Menu</a></li>
            <li><a href="antrian_user.php">Antrian</a></li>
            <li><a href="pesanan_user.php">Pesanan Anda</a></li>
            <li><a href="login.php" onclick="return confirm('Apakah kamu yakin ingin keluar?');">Log Out</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>Content Area</h2>
        <p>This is the main content area.</p>
    </div>
</body>
</html>
