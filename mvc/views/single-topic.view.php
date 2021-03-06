<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
	<?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

	<?php if ($row) : ?>

		<div class="row">
			<center style="width: 100%;">
				<h4><?= esc(ucwords($row->topic_id)) ?></h4>
			</center>
			<table class="table table-hover table-striped table-bordered">
				<tr>
					<th>Giảng viên hướng dẫn:</th>
					<td><?= esc($row->user_id) ?></td>
					<th>Ngày tạo:</th>
					<td><?= get_date($row->create_date) ?></td>
				</tr>

			</table>
		</div>

		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link <?= $page_tab == 'students' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_topic/<?= $row->topic_id ?>?tab=students">Học sinh</a>
			</li>
		</ul>



		<?php
		switch ($page_tab) {

			case 'students':
				// code...
				include(views_path('topic-tab-students'));
				break;

			case 'student-add':
				// code...
				if (Auth::access('lecturer')||Auth::access('admin')) {
					include(views_path('topic-tab-students-add'));
				} else {
					include(views_path('access-denied'));
				}

				break;

			case 'student-remove':
				// code...
				if (Auth::access('lecturer')||Auth::access('admin')) {
					include(views_path('topic-tab-students-remove'));
				} else {
					include(views_path('access-denied'));
				}


				break;

			case 'students-add':
				// code...
				if (Auth::access('lecturer')||Auth::access('admin')) {
					include(views_path('topic-tab-students-add'));
				} else {
					include(views_path('access-denied'));
				}

				break;

			default:
				// code...
				break;
		}


		?>

	<?php else : ?>
		<center>
			<h4>That topic was not found!</h4>
		</center>
	<?php endif; ?>

</div>

<?php $this->view('includes/footer') ?>