<?php
    include 'connect.php';
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboardstyle.css">
    <title>Document</title>
</head>
<body>

        <header class="header">
            <a href="#" class="logo"> LOGO </a>

            <nav class="navubaru">
                <a href="dashboard.php">Home</a>
                <a href="aboutus.php">About Us</a>
                <a href="contactus.php">Contact Us</a>
            </nav>
        </header>

    <h1>Project Report</h1>
    <div class="tbl">
        <h2>List Of Playlists Created by User johndoe</h2>
    <table class="table" cellspacing="0" width="100%" style="text-align: center;">
        <thead>
            <tr>
                <th>Playlist ID</th>
                <th>Playlist Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
                $resultset = $mysqli->query("SELECT * from tblplaylist WHERE tblplaylist.userid = ".$_SESSION['accountid']."") or die ($mysqli->error);
                while($row = $resultset->fetch_assoc()):
                echo "<tr>
                    <td>".$row['playlistid']."</td>
                    <td>".$row['playlistname']."</td>
                    </tr>";
                endwhile;?>
        </tbody>
    </table>
    <h2>List of Songs in A Complete Playlist</h2>
    <table class="table" cellspacing="0" width="100%" style="text-align: center;">
        <thead>
            <tr>
                <th>Song ID</th>
                <th>Title</th>
                <th>Artist</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT tblsongs.songid, tblartist.name, tblsongs.title from tblsongs, tblartist, tblplaylistsongs WHERE tblsongs.songid = tblplaylistsongs.songid      and tblplaylistsongs.playlistid = 53 and tblartist.artistid = tblsongs.artistid") or die ($mysqli->error);
            while($row = $resultset->fetch_assoc()):
                echo "<tr>
                    <td>".$row['songid']."</td>
                    <td>".$row['title']."</td>
                    <td>".$row['name']."</td>
                    </tr>";
            endwhile;?>
        </tbody>
    </table>
    <h2>List of Songs in KPop Genre</h2>
    <table class="table" cellspacing="0" width="100%" style="text-align: center;">
        <thead>
            <tr>
                <th>Song ID</th>
                <th>Song Title</th>
                <th>Artist</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT tblsongs.songid, tblartist.name, tblsongs.title from tblsongs, tblartist, tblgenre WHERE tblsongs.genreid = tblgenre.genreid and tblsongs.genreid = 2 and tblsongs.artistid = tblartist.artistid") or die ($mysqli->error);
            while($row = $resultset->fetch_assoc()):
                echo "<tr>
                    <td>".$row['songid']."</td>
                    <td>".$row['title']."</td>
                    <td>".$row['name']."</td>
                    </tr>";
            endwhile;?>
        </tbody>
    </table>
    </div>
</body>
</html>