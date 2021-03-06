<style>
    nav ul li a {
        width: 110px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid thin #fff;
    }

    nav ul li a:hover {
        background-color: grey;
        color: white !important;
    }

    .active-nav {
        background-color: #1c77fd;
        color: white !important;
    }

    .ms-auto {
        margin-left: 67% !important;
    }
</style>
<nav class="main-nav navbar navbar-expand-lg navbar-light bg-light p-2">
    <a class="navbar-brand" href="<?= ROOT ?>">
        <img src="<?= ROOT ?>/assets/logo.jpg" class="" style="width:50px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= ($this->controller_name() == 'Home') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>">Trang chủ</a>
            </li>

            <?php if (Auth::access('admin')) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Users') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/users">Nhân viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Students') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/students">Học sinh</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?= ($this->controller_name() == 'Topics') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/topics">Đề tài</a>
            </li>

        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= Auth::getLastname() ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?= ROOT ?>/profile">Hồ sơ</a>
                    <a class="dropdown-item" href="<?= ROOT ?>">Trang chủ</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= ROOT ?>/logout">Đăng xuất</a>
                </div>
            </li>

        </ul>


    </div>

</nav>