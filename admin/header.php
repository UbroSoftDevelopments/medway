<div class="loader">
</div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a>
                    </li>
                    <li>
                        <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <li>
                        <form class="form-inline mr-auto">
                            <div class="search-element">
                                <input class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search......" title="Type in a name" aria-label="Search" data-width="200">
                                <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" class="nav-link nav-link-lg message-toggle">
                        <i data-feather="edit" onclick="getnote(<?php echo $userid; ?>)"></i>
                    </a>
                    <div id="notebox" class="dropdown-menu dropdown-list dropdown-menu-right pullDown ">
                        <div class="dropdown-header">
                            Notes<label id="notestatus" class="text-success pull-right"></label>
                        </div>
                        <div class="dropdown-list-content  p-2">

                            <textarea cols=31 rows=8 id="notetextarea"></textarea>
                        </div>
                        <div class="dropdown-footer text-center">
                            <label class="btn btn-danger text-left" onclick="hidenote()">Cancel</label>
                            <label class="btn btn-success text-right" onclick="savenote(<?php echo $userid; ?>)">Save</label>
                        </div>
                    </div>
                </li>
                <script>
                    function hidenote() {
                        $('#notestatus').empty();
                        $('#notebox').removeClass('show');
                    }
                </script>
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                        <i data-feather="bell" class="bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">

                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="assets/logo/download.png" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Hello Sarah Smith</div>
                        <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>