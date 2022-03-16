<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<?php if($data):?>
		<div class="row">
			<div class="col-sm-8 col-md-9 bg-light p-2">
				<table class="table table-hover table-striped table-bordered">
					<tr><th>Mã đề tài:</th><td><?=esc($data->topic_id)?></td></tr>
					<tr><th>Tên đề tài:</th><td><?=esc($data->id)?></td></tr>
					<tr><th>Giảng viên hướng dẫn:</th><td><?=esc($data->user_id)?></td></tr>
					<tr><th>Số thành viên:</th><td><?=esc($amount->amount)?>/<?=esc($data->members)?></td></tr>
					<tr><th>Hạn nộp:</th><td><?=get_date($data->date_submit)?></td></tr>
				</table>
				<?php if(Auth::access('student')):?>
				<div class="text-center">
					<a href="<?=ROOT?>/topics/register">
						<button class="btn-sm btn btn-success" type="submit" value="regist" name="regist">Đăng kí</button>
				</div>
				<?php endif;?>
				<div class="btn btn-primary">
					<a href="<?=ROOT?>/topics">
						<button class="btn btn-primary" onclick=history.back()>Trở lại</button>
				</div>
			</div>
		</div>
		<br>
		<?php else:?>
			<center><h4>Không có thông tin tìm thấy</h4></center>
		<?php endif;?>

	</div>
	
<?php $this->view('includes/footer')?>