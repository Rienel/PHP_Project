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
    <link rel="stylesheet" href="indexstyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/dashboard.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
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
            <li><a href="projectreport.php">
                <span><i class="fa-solid fa-user"></i></span>
            <span>Admin</span>
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
        <div class="sidebar-nav2">
            <div class="logo">
                <a href=""></a>
            </div>
            <ul>
                <li><a href="">
                    <span><i class="fa-solid fa-book"></i></span>
                <span>Genre</span>
            </a></li>
            <li>
                <div class="sidebar-scroll">
                    <div class="create-playlist">
                        <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
                            $resultset = $mysqli->query("SELECT * from tblgenre") or die ($mysqli->error);
                        ?>
                        <?php
                            while($row = $resultset->fetch_assoc()):
                        ?>
                        <?php
                            echo "<a href='songgenre.php?id=".$row['genreid']."'>".$row['genrename']."</a>";
                            ?>
                        <?php endwhile;?>
                    </div>
                </div>
            </li>
            </ul>
        </div>
    </div>
    <div class="main-section">
        <div class="top-nav">
            <div class="username">
                <?php
                        echo "<span>".$_SESSION['username']."<span>";
                ?>
            </div>
        </div>
        <div class="playlist">
            <h2>Artists<h2>
            <?php
                $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
                $resultset = $mysqli->query("SELECT * from tblsongs, tblartist WHERE tblsongs.artistid = tblartist.artistid") or die ($mysqli->error);
            ?>
            <div class="card">
                    <?php
                        while($row = $resultset->fetch_assoc()):
                    ?>
                    <?php
                    echo "<div class='item'>
                            <img src='images/artist".$row['songid'].".jpg'>
                            <a href='artistsongs.php?id=".$row['artistid']."'>
                            <div class='btnPlay' onclick='location.href=''''>
                                <span><i class='fa-solid fa-play'></i></span>
                            </div>
                            </a>
                            <h4>".$row['name']."</h4>
                        </div>";
                        ?>
                    <?php endwhile;?>
            </div>
        </div>
        <div class="playlist">
            <h2>Songs<h2>
            <?php
                $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
                $resultset = $mysqli->query("SELECT songid, title, tblartist.name from tblsongs, tblartist WHERE tblsongs.artistid = tblartist.artistid") or die ($mysqli->error);
            ?>
            <div class="card">
                    <?php
                        while($row = $resultset->fetch_assoc()):
                    ?>
                    <?php
                    echo "<div class='item'>
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
        <div class="playlist-form">
        
        <div class="edit-playlist">
        <div class="btnClose"><button id="btnClose">&#10006</button></div>
            <span>Create Playlist</span>
            <div class="playlist-name">
                <form method="post">
                    <input type="text" placeholder="Playlist name" name="txtplaylist">
            </div>
            <div class="btnSubmit">
                    <button class="buttonCreate" type="submit" id="createPlaylist" name="btnCreate">Create</button>
            </div>
            </form>
            <?php	
                if(isset($_POST['btnCreate'])){		
                    //retrieve data from form and save the value to a variable
                    //for tbluserprofile
                    $playlistname=$_POST['txtplaylist'];	
                    
                    
                    
                    //save data to tbluserprofile			
                    $sql1 ="Insert into tblplaylist(userid, playlistname) values('".$_SESSION['accountid']."','".$playlistname."')";
                    mysqli_query($connection,$sql1);
                    
                }

            ?>
        </div>
    </div>
        
        <div class="playlist">
            <h2>Your Playlists<h2>
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT * from tblplaylist WHERE userid = ".$_SESSION['accountid']."") or die ($mysqli->error);
            ?>
            <div class="card">
            <?php
                        while($row = $resultset->fetch_assoc()):
                    ?>
                      
                    <?php
                    echo "<div class='item'>
                    <a href='deleteplaylists.php?id=".$row['playlistid']."'>x</a>
                            <img src='images/playlist.jpg'>
                            <a href='playlistsongs.php?id=".$row['playlistid']."'>
                            <div class='btnPlay' onclick='location.href='playlistsongs.php?id=".$row['playlistid']."'''>
                                <span><i class='fa-solid fa-play'></i></span>
                            </div>
                            </a>
                            <h4>".$row['playlistname']."</h4>
                            <p>BINI</p>
                        </div>";
                        ?>
                    <?php endwhile;?>
            </div>
        </div>
    </div>
    
    <script>
        $("#btnCreatePlaylist").click(function() {
            $(".playlist-form").css("display", "flex");
        })
        $("#btnClose").click(function() {
            $(".playlist-form").css("display", "none");
        })
        
    </script>
    
</body>
</html>