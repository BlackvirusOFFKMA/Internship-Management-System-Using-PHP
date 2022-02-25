<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<style>
    h1{
        font-size: 80px;
        color: limegreen;
    }

    a{
        text-decoration: none;
    }

    .card-header{
        font-weight: bold;
    }

    .card{
        min-width: 250px;
    }
</style>
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">

    <div class="row justify-content-center ">


        <?php if(Auth::access('admin')):?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?=ROOT?>/users">
                    <div class="card-header">Nhân Viên</div>
                    <h1 class="text-center">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </h1>
                    <div class="card-footer">Xem tất cả các nhận viên</div>
                </a>
            </div>
        <?php endif;?>

        <?php if(Auth::access('lecturer')):?>
            <div class="card col-3 shadow rounded m-4 p-0 border">
                <a href="<?=ROOT?>/students">
                    <div class="card-header">Học Sinh</div>
                    <h1 class="text-center">
                        <i class="fa fa-user-graduate"></i>
                    </h1>
                    <div class="card-footer">Xem tất cả học sinh</div>
                </a>
            </div>
        <?php endif;?>

                <div class="card col-3 shadow rounded m-4 p-0 border">
	 				<a href="<?=ROOT?>/topics">
		 			<div class="card-header">Đề tài</div>
		 			<h1 class="text-center">
		 				<i class="fa fa-book"></i>
		 			</h1>
		 			<div class="card-footer">Xem tất cả các đề tài</div>
		 			</a>
		 		</div>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?=ROOT?>/profile">
                <div class="card-header">Hồ sơ</div>
                <h1 class="text-center">
                    <i class="fa fa-id-card"></i>
                </h1>
                <div class="card-footer">Xem thông tin cá nhân</div>
            </a>
        </div>

        <div class="card col-3 shadow rounded m-4 p-0 border">
            <a href="<?=ROOT?>/logout">
                <div class="card-header">Đăng xuất</div>
                <h1 class="text-center">
                    <i class="fa fa-sign-out-alt"></i>
                </h1>
                <div class="card-footer">Thoát khỏi hệ thống</div>
            </a>
        </div>

    </div>
</div>

<?php $this->view('includes/footer')?>
