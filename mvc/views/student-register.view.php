<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
		<?php $this->view('includes/crumbs',['crumbs'=>$crumbs])?>

		<?php if($row):?>
		<div class="card-group justify-content-center">
 

			 <form method="post">
			 	<h3>Bạn có chắc là muốn đăng kí đề tài này</h3>
 
			 	<input disabled autofocus class="form-control" value="<?=get_var('topic',$row[0]->topic)?>" type="text" name="class" placeholder="Topic Name"><br><br>
			 	<input type="hidden" name="id">
			 	<input class="btn btn-success float-end" type="submit" value="Đăng kí">

			 	<a href="<?=ROOT?>/topics">
			 		<input class="btn btn-primary" type="button" value="Cancel">
			 	</a>
			 </form>
			
		</div>
		<?php else: ?>

			<div style="text-align: center;">
				<h3>Đề tài không được tìm thấy</h3>
				<div class="clearfix"></div>
				<br><br>
				<a href="<?=ROOT?>/topics">
			 		<input class="btn btn-danger" type="button" value="Cancel">
			 	</a>
		 	</div>
		<?php endif; ?>

		
	 
	</div>
 
<?php $this->view('includes/footer')?>