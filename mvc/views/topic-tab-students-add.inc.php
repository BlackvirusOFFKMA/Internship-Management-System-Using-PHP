<form method="post" class="form mx-auto" style="width:100%;max-width: 400px;">
	<br><h4>Thêm học sinh</h4>

	 	<?php if(count($errors) > 0):?>
			<div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
			  <strong>Errors:</strong>
			   <?php foreach($errors as $error):?>
			  	<br><?=$error?>
			  <?php endforeach;?>
			  <span  type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </span>
			</div>
		<?php endif;?>
		
	<input value="<?=get_var('name')?>" autofocus class="form-control" type="text" name="name" placeholder="Student Name">
	<br>
	<a href="<?=ROOT?>/single_topic/<?=$row->topic_id?>?tab=students">
		<button type="button" class="btn btn-danger">Hủy bỏ</button>
	</a>
	<button class="btn btn-primary float-end" name="search">Tìm</button>
	<div class="clearfix"></div>
</form>
<br>
<form method="post">
	<div class="card-group justify-content-center">

		<?php if(isset($results) && $results):?>
			 
			<?php foreach ($results as $row):?>
				<?php include(views_path('users'))?> 
			<?php endforeach;?>
			
		<?php else:?>
	 		
	 		<?php if(count($_POST) > 0):?>
	 			<center><hr><h4>Không có kết quả được tìm thấy</h4></center>
	 		<?php endif;?>
	 	<?php endif;?>

	</div>
</form>
