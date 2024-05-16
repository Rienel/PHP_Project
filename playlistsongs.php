<?php
include 'connect.php';
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <title>Document</title>
</head>
<?php
    
    $_SESSION['playlistid'] =  $_GET['id'];
   
    // sql to get playlist name
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
                        <button id="btnEditPlaylist">Edit Playlist</button>    
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<?php
if(isset($_POST['btnAdd'])) {		
    $songid = $_POST['txtsongid'];
    $sql1 = "INSERT INTO tblplaylistsongs (playlistid, songid) VALUES ('".$_SESSION['playlistid']."', '$songid')";
    mysqli_query($connection, $sql1);
}    

$mysqli = new mysqli('localhost', 'root', '', 'dbbaringf2') or die (mysqli_error($mysqli));
$resultset = $mysqli->query("SELECT tblsongs.songid, tblartist.name, tblsongs.title FROM tblsongs, tblartist, tblplaylistsongs WHERE tblsongs.songid = tblplaylistsongs.songid AND tblplaylistsongs.playlistid = '".$_SESSION['playlistid']."' AND tblartist.artistid = tblsongs.artistid") or die ($mysqli->error);
?>
<div class="main-section">
    <div class="top-nav">
        <div class="username">
            <?php echo "<span>".$_SESSION['username']."</span>"; ?>
        </div>
    </div>
    <div class="playlist">
        <?php echo "<h2>".$playlistname."</h2>"; ?>
        <div class="card">
            <?php while($row = $resultset->fetch_assoc()): ?>
                <div class='item'>
                    <a href='deletesong.php?id=<?php echo $row['songid']; ?>'>x</a>
                    <img src='images/song<?php echo $row['songid']; ?>.jpg'>
                    <a href='musicpage.php?id=<?php echo $row['songid']; ?>'>
                        <div class='btnPlay'>
                            <span><i class='fa-solid fa-play'></i></span>
                        </div>
                    </a>
                    <h4><?php echo $row['title']; ?></h4>
                    <p><?php echo $row['name']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="playlist-form">
        <div class="edit-playlist">
            <div class="btnClose"><button id="btnClose">&#10006</button></div>
            <span>Edit Playlist</span>
            <div class="playlist-name">
                <form method="post">
                    <input type="text" placeholder="Playlist name" name="txteditplaylist">
            </div>
            <div class="btnSubmit">
                <button type="submit" id="createPlaylist" name="btnEdit">Save</button>
            </div>
            </form>
            <?php	
                if(isset($_POST['btnEdit'])) {		
                    $playlistname = $_POST['txteditplaylist'];	
                    $sql1 = "UPDATE tblplaylist SET playlistname = '$playlistname' WHERE playlistid = '".$_SESSION['playlistid']."'";
                    if (mysqli_query($connection, $sql1)) {
                        mysqli_close($connection);
                        header("Location: playlistsongs.php?id=".$_SESSION['playlistid']); // Redirect to the playlist page
                        exit;
                    } else {
                        echo "Error updating record";
                    }
                }
            ?>
        </div>
    </div>
</div>
<script>
    $("#btnEditPlaylist").click(function() {
        $(".playlist-form").css("display", "flex");
    })
    $("#btnClose").click(function() {
        $(".playlist-form").css("display", "none");
    })
</script>
</body>
</html>
