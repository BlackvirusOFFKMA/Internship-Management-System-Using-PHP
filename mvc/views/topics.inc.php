<div class="card-group justify-content-center">

	<table class="table table-striped table-hover">
		<tr><th></th><th>Mã đề tài</th><th>Mô tả</th><th>Hạn chót nộp bài</th>
			<th>
				
			</th>
		</tr>
		<?php // print_r($rows) ?>
		<?php if(isset($rows) && $rows):?>
			 
			<?php foreach ($rows as $row):?>
			 
			 <tr>
			 	<td>
					<?php if(Auth::getRank('lecturer')) : ?>
						<a href="<?=ROOT?>/single_topic/<?=$row->topic_id?>">
							<button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
						</a>
					<?php elseif(Auth::getRank('student')) : ?>
						<a href="<?=ROOT?>topics/view_topic/<?=$row->topic_id?>">
							<button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
						</a>
					<?php endif;?>
			 	</td>
			 	<td><?=$row->topic_id?></td><td><?=$row->topic?> </td><td><?=$row->date_submit?></td>

			 	<td>
			 		<?php if(Auth::access('lecturer')):?>
				 		<a href="<?=ROOT?>/topics/edit/<?=$row->id?>">
				 			<button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
				 		</a>

				 		<a href="<?=ROOT?>/topics/delete/<?=$row->id?>">
				 			<button class="btn-sm btn btn-danger"><i class="fa fa-trash-alt"></i></button>
				 		</a>
				 	<?php endif;?>
			 	</td>

			 </tr>

 			<?php endforeach;?>
			<?php else:?>
				<tr><td colspan="5"><center>Không có đề tài bạn tìm kiếm</center></td></tr>
			<?php endif;?>

	</table>
</div>