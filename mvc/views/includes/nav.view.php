<style>
    nav ul li a{
        width: 110px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid thin #fff;
    }
    nav ul li a:hover{
        background-color: grey;
        color: white !important;
    }

    .active-nav{
        background-color: #1c77fd;
        color: white !important;
    }
</style>
<nav class="main-nav navbar navbar-expand-lg navbar-light bg-light p-2">
    <a class="navbar-brand" href="<?=ROOT?>">
        <img src="<?=ROOT?>/assets/logo.png" class="" style="width:50px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?=($this->controller_name() == 'Home') ? ' active-nav ':''?> " href="<?=ROOT?>">DASHBOARD</a>
            </li>

            <?php if(Auth::access('admin')):?>
                <li class="nav-item">
                    <a class="nav-link <?=($this->controller_name() == 'Users') ? ' active-nav ':''?> " href="<?=ROOT?>/users">STAFF</a>
                </li>
            <?php endif;?>

            <?php if(Auth::access('reception')):?>
                <li class="nav-item">
                    <a class="nav-link <?=($this->controller_name() == 'Students') ? ' active-nav ':''?> " href="<?=ROOT?>/students">STUDENTS</a>
                </li>
            <?php endif;?>

            <li class="nav-item">
                <a class="nav-link <?=($this->controller_name() == 'Classes') ? ' active-nav ':''?> " href="<?=ROOT?>/classes">CLASSES</a>
            </li>

        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?=Auth::getFirstname()?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?=ROOT?>/profile">Profile</a>
                    <a class="dropdown-item" href="<?=ROOT?>">Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=ROOT?>/logout">Logout</a>
                </div>
            </li>

        </ul>


    </div>

</nav>

