<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<div class="card-group justify-content-center">
 
			 <form method="post">
			 	<h3>Thêm mới đề tài</h3>

			 	<?php if(count($errors) > 0):?>
				<div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
				  <strong>Lỗi:</strong>
				   <?php foreach($errors as $error):?>
				  	<br><?=$error?>
				  <?php endforeach;?>
				  <span  type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </span>
				</div>
				<?php endif;?>
			
				<input autofocus class="form-control" value="<?=get_var('topic_id')?>" type="text" name="topic_id" placeholder="Mã đề tài"><br><br>
			 	<input autofocus class="form-control" value="<?=get_var('topic')?>" type="text" name="topic" placeholder="Tên đề tài"><br><br>
				<input autofocus class="form-control" value="<?=get_var('date_submit')?>" type="date" name="date_submit" placeholder="Hạn nộp"><br><br>
				<input autofocus class="form-control" value="<?=get_var('max_members')?>" type="number" name="members" placeholder="Số lượng sinh viên"><br><br>
				<input class="btn btn-primary float-end" type="submit" value="Create">

			 	<a href="<?=ROOT?>/topics">
			 		<input class="btn btn-danger" type="button" value="Cancel">
			 	</a>
			 </form>
		</div>

		
	 
	</div>
 
<?php $this->view('includes/footer')?>