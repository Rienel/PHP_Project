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
    <link rel="stylesheet" href="indexstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/dashboard.js"></script>
    <title>Document</title>
</head>
<?php
    
    $_SESSION['playlistid'] =  $_GET['id'];
   
    
    // sql to delete a record
    $sql = "SELECT playlistname FROM tblplaylist WHERE playlistid = '".$_SESSION['playlistid']."'";
    
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result);
    $playlistname = $row[0];

?>
<body>
<div class="sidebar">
        <div class="sidebar-nav">
            <div class="logo">
                <a href=""></a>
            </div>
            <ul>
                <li><a href="dashboard.php">
                    <span><i class="fa-solid fa-house"></i></span>
                <span>Home</span>
            </a></li>
            <li><a href="">
                <span><i class="fa-solid fa-magnifying-glass"></i></span>
            <span>Search</span>
        </a></li>
            </ul>
        </div>
        <div class="sidebar-nav2">
            <div class="logo">
                <a href=""></a>
            </div>
            <ul>
                <li><a href="">
                    <span><i class="fa-solid fa-book"></i></span>
                <span>Your Library</span>
            </a></li>
            <li>
                <div class="sidebar-scroll">
                    <div class="create-playlist">
                        <h4>Create your first playlist</h4>
                        <p>It's easy, we'll help you</p>
                        <button id="btnCreatePlaylist">Create Playlist</button>    
                    </div>
                </div>
            </li>
            </ul>
        </div>
    </div>

    <?php
                if(isset($_POST['btnAdd'])){		
                    //retrieve data from form and save the value to a variable
                    //for tbluserprofile
                    $songid=$_POST['txtsongid'];
                    
                    
                    
                    
                    $sql1 ="Insert into tblplaylistsongs(playlistid, songid) values('".$_SESSION['playlistid']."','".$songid."')";
                    //save data to tbluserprofile			
                    
                    mysqli_query($connection,$sql1);
                    
                }    

            ?>
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT tblsongs.songid, tblartist.name, tblsongs.title from tblsongs, tblartist, tblplaylistsongs WHERE tblsongs.songid = tblplaylistsongs.songid and tblplaylistsongs.playlistid = '".$_SESSION['playlistid']."' and tblartist.artistid = tblsongs.artistid") or die ($mysqli->error);
        ?>
        <div class="main-section">
        <div class="top-nav">
            <div class="username">
            <?php
                        echo "<span>".$_SESSION['username']."<span>";
                    ?>
            </div>
        </div>
        <div class="playlist">
        <?php
            echo "<h2>".$playlistname."</h2>";
        ?>
            
            <div class="card">
                    <?php
                        while($row = $resultset->fetch_assoc()):
                    ?>
                    <?php
                    echo "<div class='item'>
                    <a href='deletesong.php?id=".$row['songid']."'>x</a>
                            <img src='images/song".$row['songid'].".jpg'>
                            <a href='musicpage.php?id=".$row['songid']."'>
                            <div class='btnPlay' onclick='location.href=''''>
                                <span><i class='fa-solid fa-play'></i></span>
                            </div>
                            </a>
                            <h4>".$row['title']."</h4>  
                            <p>".$row['name']."</p>
                        </div>";
                        ?>
                    <?php endwhile;?>
            </div>
        </div>
    </div>
        
</body>
</html>