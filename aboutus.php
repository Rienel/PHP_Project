<?php
    include 'connect.php';
    // require_once 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<link rel="stylesheet" href="css/ab-ct-style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
</head>
<html>
	<body>
        <header class="header">
                <a href="about_us.php" class="logo"> LOGO HERE </a>

                <nav class="navubaru">
                    <a href="login.php">Login</a>
                    <a href="register.php">Sign Up</a>
                    <a href="aboutus.php">About Us</a>
                    <a href="contactus.php">Contact Us</a>
                </nav>
        </header>
    
        <div class="container_ab">
            <!--Video-->
            <div class="vid-section">
                <div class="video">
                    <video id="vid_app" autoplay loop muted>
                        <source src="css/Images-Vids/Re-frained.mp4" type="video/mp4">
                    </video>
                </div>
            </div>

            <!--Information-->
            <div class="ab_us">
                <div class="pad_ab">
                    <br>
                    <h3 class="about">About Us</h3>
                    <br>


                    <div class="text">
                        Welcome to <a href="#"><strong>Refrained</strong></a> 
                        where the love for music meets innovative technology! <br>
                        Founded by two passionate developers, <strong>Rienel Basilisco</strong>, and <strong>Mark Baring</strong>, 
                        our journey <br>began with a shared vision: 
                        to create a platform that celebrates the universal love for music. <br>
                        <br>At Refrained, we believe in the power of <strong>connection through music</strong>. 
                        <br>Whether you're a casual listener or a dedicated audiophile, 
                        our platform <br>offers a seamless experience tailored to your musical preferences. <br>
                        <br>Driven by our devotion to music and fueled by our expertise in technology, 
                        <br>we've crafted Refrained to be more than just a music streaming service. 
                        <br>It's a <strong>community</strong>, a <strong>sanctuary</strong> for music enthusiasts to discover new artists, 
                        <br>rediscover old favorites, and connect with fellow music lovers. <br>
                        <br>With a diverse catalog spanning genres and eras, curated playlists, 
                        <br><strong>personalized recommendations</strong>, and exclusive features, 
                        <br>Refrained is your ultimate destination for all things music. 
                        <br>Join us on this melodic journey and let the rhythm guide you. 
                        <br><strong>Let's make every moment Refrained.</strong>
                    </div>
                </div>
            </div>

            <!--Social Media-->
            <div class="social_med">
                <h3 class="about">Social Media</h3>

                <div class="imgs">
                    <div class="rb_info">
                        <div class="rb_img">
                            <img class="rb" src="">
                        </div>
                        <p><strong>Rienel Basilisco</strong><br>Facebook: <a href="https://www.facebook.com/profile.php?id=100072880541770">Rienel Basilisco</a><br></p>
                    </div>

                    <div class="br_info">
                        <div class="br_img">
                            <img class="br" src="">
                        </div>
                        <p><strong>Mark Baring</strong><br>Facebook: <a href="https://www.facebook.com/markadrian.baring.54">Mark Baring</a><br></p>
                    </div>
                </div> 
            </div>
        </div>
	</body>
</html>