<nav class="navbar navbar-expand">
    <a class="sidebar-toggle text-light mr-3 btn btn-default"><i style="color:rgba(0,0,0,0.5)" class="fa fa-bars"></i></a>
    <a><img src="../../includes/img/seal.png" width="40" height="40"></a><a href="index.php" id="nav-title"><span id="iwpms">INDIVIDUAL WORKING PERMIT MANAGEMENT SYSTEM</span><br>Local Government of Bauang La Union</a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <span class="nav-link dropdown-toggle d-inline" href="#" data-toggle="dropdown">
                    <span><i class="fa fa-user d-inline"></i> <small id="user">&nbsp; <?php echo $_SESSION['fullname'];?></small></span>
                </span>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <center><a id = 'logout' class="dropdown-item" href="javascript:;" ><span class="fa fa-fw fa-sign-out"></span> Sign out</a></center>
                </div>
            </li>
        </ul>
    </div>

</nav>