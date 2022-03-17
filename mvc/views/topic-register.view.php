<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>
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
		<?php if($row):?>
		<div class="row">
			<div class="col-sm-8 col-md-12 bg-light p-2">
				<table class="table table-hover table-striped table-bordered">
					<tr><th>Mã đề tài:</th><td><?=esc($row->topic_id)?></td></tr>
					<tr><th>Tên đề tài:</th><td><?=esc($row->topic)?></td></tr>
					<tr><th>Giảng viên hướng dẫn:</th><td><?=esc($row->user_id)?></td></tr>
					<tr><th>Số thành viên:</th><td><?=esc($amount->amount)?>/<?=esc($row->members)?></td></tr>
					<tr><th>Hạn nộp:</th><td><?=get_date($row->date_submit)?></td></tr>
				</table>
				<?php if(Auth::access('student')):?>
				<div class="text-center">
					<a href="<?=ROOT?>/single_topic/register">
						<button class="btn btn-primary btn-success" type="submit" value="regist" name="regist">Đăng kí</button>
					</a>
					<a href="<?=ROOT?>/topics">
						<button class="btn btn-primary" onclick=history.back()>Trở lại</button>
					</a>
				</div>
				<?php endif;?>
			</div>
		</div>
		<br>
		<?php else:?>
			<center><h4>Không có thông tin tìm thấy</h4></center>
		<?php endif;?>

	</div>
	
<?php $this->view('includes/footer')?>