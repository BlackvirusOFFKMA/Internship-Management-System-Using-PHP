<div class="card-group justify-content-center">

	<table class="table table-striped table-hover">
		<tr><th></th><th>Topic ID</th><th>Description</th><th>Deadline</th>
			<th>
				
			</th>
		</tr>
		<?php if(isset($rows) && $rows):?>
			 
			<?php foreach ($rows as $row):?>
			 
			 <tr>
			 	<td>
					<?php if(Auth::access('lecturer')):?>
						<a href="<?=ROOT?>/single_topic/<?=$row->topic_id?>?tab=students">
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
				<tr><td colspan="5"><center>No topics were found at this time</center></td></tr>
			<?php endif;?>

	</table>
</div>