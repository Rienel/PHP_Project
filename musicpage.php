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
    <link rel="stylesheet" href="musicpagestyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    $songid = $_GET['id'];
   
    
    // sql to delete a record
    $sql = "SELECT songid, title, tblartist.name FROM tblsongs, tblartist WHERE songid = '".$songid."' and tblsongs.artistid = tblartist.artistid";
    
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result);
    $songid = $row[0];
    $songname = $row[1];
    $songartist = $row[2];

    ?>
    <div class="container">
        <div class="top" id="btnDashboard" id="btnDashboard">
            <i class="fa-solid fa-house"></i>
        </div>
        <?php
            echo "<img class='cover-image' src='images/song".$songid.".jpg'></img>";
        ?>
        <div class="player-body"></div>
        
        <div class="info">
            <?php
                echo "<h2>".$songname."</h2>
                    <h3>".$songartist."</h3>";
            ?>
        </div>
        
        <div class="controls2">
            <audio controls>
                <source src="ONESPARK.mp3" type="audio/mpeg">
            </audio>
        </div>
    </div>
    <div class="center">
        <button id="btnPlaylist">Add to Playlist</button>
    </div>
    <div class="pop-up">
        <div class="btnClose">x</div>
        <div class="playlists">
            <h2>Add to Playlist</h2>
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT * from tblplaylist WHERE userid = ".$_SESSION['accountid']."") or die ($mysqli->error);
            ?>
            <?php
                        while($row = $resultset->fetch_assoc()):
                    ?>
            <?php
                echo "<div class='form-element'>
                <label>".$row['playlistname']."</label>
                <form method='post'>
                    <input type='text' placeholder='Song name' value='".$row['playlistid']."' name='txtplaylistid'>
                    <button type='submit' name='btnAdd'>Add</button>
                </form>
                
            </div>";
            ?>
            <?php endwhile;?>
            <?php	
                if(isset($_POST['btnAdd'])){		
                    //retrieve data from form and save the value to a variable
                    //for tbluserprofile
                    $playlistid=$_POST['txtplaylistid'];	
                    
                    
                    
                    //save data to tbluserprofile			
                    $sql1 ="Insert into tblplaylistsongs(playlistid, songid) values('".$playlistid."','".$songid."')";
                    mysqli_query($connection,$sql1);
                    
                }

            ?>
        </div>
    </div>
    <script>
        $("#btnPlaylist").click(function() {
            $(".pop-up").addClass("active");
        })
        $(".pop-up .btnClose").click(function() {
            $(".pop-up").removeClass("active");
        })
        $("#btnDashboard").click(function() {
            window.location.href = 'dashboard.php';
        })
        
    </script>
    
    
</body>
</html>