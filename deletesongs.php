<?php
include 'connect.php';
session_start();

if (isset($_GET['id'])) {
    $songid = $_GET['id'];
    $playlistid = $_SESSION['playlistid'];

    // Remove the song from the playlist
    $deleteSongQuery = "DELETE FROM tblplaylistsongs WHERE playlistid = '$playlistid' AND songid = '$songid'";
    if (mysqli_query($connection, $deleteSongQuery)) {
        // Check if there are any songs left in the playlist
        $checkSongsQuery = "SELECT COUNT(*) as songCount FROM tblplaylistsongs WHERE playlistid = '$playlistid'";
        $result = mysqli_query($connection, $checkSongsQuery);
        $row = mysqli_fetch_assoc($result);

        if ($row['songCount'] == 0) {
            // If no songs left, set isRemoved to 1
            $updatePlaylistQuery = "UPDATE tblplaylist SET isRemoved = 1 WHERE playlistid = '$playlistid'";
            mysqli_query($connection, $updatePlaylistQuery);
        }
    } else {
        echo "Error removing song: " . mysqli_error($connection);
    }

    // Redirect back to the playlist page
    header("Location: playlistsongs.php?id=$playlistid");
    exit;
}
?>
