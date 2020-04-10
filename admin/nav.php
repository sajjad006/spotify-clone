<div id="mySidenav" class="sidenav">
    <ul class="menu">
        <li style="width: auto;"><h3 style="margin-bottom: 40px;">Spotify Dashboard</h3></li>
        <li><a class="item-head" href="includes/logout.php">Welcome Admin <i class="fas fa-sign-out-alt"></i></a></li>
        <li>
            <a class="item-head" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="fas fa-heartbeat"></i> Genre <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu1" role="menu" aria-labelledby="btn-1">
                <li><a href="genre.php">Add New genre</a></li>
                <li><a href="genre.php">View Genre</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-2" data-toggle="collapse" data-target="#submenu2" aria-expanded="false"><i class="fas fa-headphones"></i> Moods <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu2" role="menu" aria-labelledby="btn-2">
                <li><a href="mood.php">Add New Mood</a></li>
                <li><a href="mood.php">View Moods</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-3" data-toggle="collapse" data-target="#submenu3" aria-expanded="false"><i class="fas fa-crown"></i> Artists <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu3" role="menu" aria-labelledby="btn-3">
                <li><a href="artists.php">Add New artist</a></li>
                <li><a href="artists.php">View Artist</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-7" data-toggle="collapse" data-target="#submenu7" aria-expanded="false"><i class="fas fa-music"></i> Songs <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu7" role="menu" aria-labelledby="btn-7">
                <li><a href="songs.php">Add New Songs</a></li>
                <li><a href="songs.php">View Songs</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-4" data-toggle="collapse" data-target="#submenu4" aria-expanded="false"><i class="far fa-user"></i> Users <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu4" role="menu" aria-labelledby="btn-4">
                <li><a href="users.php">View Users</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-5" data-toggle="collapse" data-target="#submenu5" aria-expanded="false"><i class="fas fa-list"></i> Favourites <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu5" role="menu" aria-labelledby="btn-5">
                <li><a href="favourites.php">View Favourites</a></li>
            </ul>
        </li>

        <li>
            <a class="item-head" id="btn-6" data-toggle="collapse" data-target="#submenu6" aria-expanded="false"><i class="fas fa-home"></i> Homepage <span class="caret"></span></a>
            <ul class="nav collapse sub" id="submenu6" role="menu" aria-labelledby="btn-6">
                <li><a href="home-manage.php">Manage Homepage</a></li>
            </ul>
        </li>

        <li><a class="item-head" href="../about.php"><i class="fas fa-info"></i> About</a></li>
    </ul>
    <hr>
</div>

<div class="container-fluid" id="main">

    <nav class="navbar navbar-default">
        <!-- <div>
            <span style="font-size:30px;cursor:pointer" onclick="toggleNav()">&#9776;</span>
        </div>
        -->
        <div class="navbar-header">
            <span style="font-size:30px;cursor:pointer;margin: 10px;background-color: #d793f5" onclick="toggleNav()">&#9776;</span>
        </div>

        <ul class="nav navbar-nav navbar-right sub-head" style="margin-right: 20px;">
          <li><a href="index.php">Home</a></li>
          <li><a href="../about.php">About</a></li>
          <li><a href="includes/logout.php">Logout</a></li>
        </ul>
    </nav>
</div>