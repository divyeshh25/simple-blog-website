<!-- Navigation-->
<?php
?>
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.php">About</a></li>
                <!-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.php">Sample Post</a></li> -->
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.php">Contact</a></li>
                <?php
                if(isset( $_SESSION['user']) &&  $_SESSION['user']== true)
                {
                    
                    echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='logout.php'>Logout</a></li>";
                }
                else
                {
                    echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='login.php'>Login</a></li>";
                }
                ?>
                
            </ul>
        </div>
    </div>
</nav>