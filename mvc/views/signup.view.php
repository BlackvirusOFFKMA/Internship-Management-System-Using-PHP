<?php $this->view('includes/header') ?>

<div class="container-fluid">

    <form method="post">
        <div class="p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px;width:100%;max-width: 340px;">
            <h2 class="text-center">Học Viện Kỹ Thuật Mật Mã</h2>
            <img src="<?= ROOT ?>/assets/logo.jpg" class="border border-primary d-block mx-auto rounded-circle" style="width:100px;">
            <h3>Thêm người dùng</h3>


            <input class="my-2 form-control" value="<?= get_var('firstname') ?>" type="firstname" name="firstname" placeholder="Họ">
            <input class="my-2 form-control" value="<?= get_var('lastname') ?>" type="lastname" name="lastname" placeholder="Tên">
            <input class="my-2 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">

            <select class="my-2 form-control" name="gender">
                <option <?= get_select('gender', '') ?> value="">--Chọn một giới tính--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Nam</option>
                <option <?= get_select('gender', 'female') ?> value="female">Nữ</option>
            </select>


            <?php if($mode == 'students'):?>
				<input type="hidden" value="student" name="rank">
			<?php else:?>
                <select class="my-2 form-control" name="rank">
                    <option <?= get_select('rank', '') ?> value="">--Chọn chức vụ--</option>
                    <option <?=get_select('rank','student')?> value="student">Học sinh</option>
                    <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Giáo viên</option>
                    <?php if (Auth::getRank() == 'admin') : ?>
                        <option <?= get_select('rank', 'admin') ?> value="super_admin">Admin</option> -->
                    <?php endif; ?>

                </select>
            <?php endif;?>


            <input class="my-2 form-control" value="<?= get_var('password') ?>" type="password" name="password" placeholder="Mật khẩu">
            <input class="my-2 form-control" value="<?= get_var('password2') ?>" type="password" name="password2" placeholder="Nhập lại mật khẩu">
            <br>
            <button class="btn btn-primary float-end">Thêm</button>


            <?php if($mode == 'students'):?>
				<a href="<?=ROOT?>/students">
					<button type="button" class="btn btn-danger">Hủy bỏ</button>
				</a>
			<?php else:?>
				<a href="<?=ROOT?>/users">
					<button type="button" class="btn btn-danger">Hủy bỏ</button>
				</a>
			<?php endif;?>

            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
                    <strong>Lỗi:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <br><?= $error ?>
                    <?php endforeach; ?>
                    <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
            <?php endif; ?>


        </div>
    </form>
</div>

<?php $this->view('includes/footer') ?>