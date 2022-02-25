<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<?php if($row):?>

		<?php
 			$image = get_image($row->image,$row->gender);
 		?>

		<div class="row">
			<div class="col-sm-4 col-md-3">
				<img src="<?=$image?>" class="border border-primary d-block mx-auto rounded-circle " style="width:150px;">
				<h3 class="text-center"><?=esc($row->firstname)?> <?=esc($row->lastname)?></h3>
				<br>
				<?php if(Auth::access('admin') || (Auth::access('lecturer') && $row->rank == 'student')):?>
				<div class="text-center">
					<a href="<?=ROOT?>/profile/edit/<?=$row->user_id?>">
						<button class="btn-sm btn btn-success">Edit</button>
					</a>
					<a href="<?=ROOT?>/profile/delete/<?=$row->user_id?>">
						<button class="btn-sm btn btn-danger">Delete</button>
					</a>
				</div>
				<?php endif;?>
			</div>
			<div class="col-sm-8 col-md-9 bg-light p-2">
				<table class="table table-hover table-striped table-bordered">
					<tr><th>Họ:</th><td><?=esc($row->firstname)?></td></tr>
					<tr><th>Tên:</th><td><?=esc($row->lastname)?></td></tr>
					<tr><th>Email:</th><td><?=esc($row->email)?></td></tr>
					<tr><th>Giới tính:</th><td><?=esc($row->gender)?></td></tr>
					<tr><th>Chức vụ:</th><td><?=ucwords(str_replace("_"," ",$row->rank))?></td></tr>
					<tr><th>Ngày tạo:</th><td><?=get_date($row->date)?></td></tr>
					<?php if($row->rank == 'student'):?>
						<tr><th>Score:</th><td><?=esc($score->score)?></td></tr>
					<?php endif;?>
					<?php if($row->rank == 'student'):?>
						<tr><th>Đề tài:</th><td><?=esc($topic->topic)?></td></tr>
					<?php endif;?>

				</table>
			</div>
		</div>
		<br>
		<?php else:?>
			<center><h4>Không có thông tin tìm thấy</h4></center>
		<?php endif;?>

	</div>

<?php $this->view('includes/footer')?>
