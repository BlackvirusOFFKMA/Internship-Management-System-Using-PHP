<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
	<?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

	<nav class="navbar navbar-light bg-light">
		<form class="form-inline">
			<div class="input-group">
				<div class="input-group-prepend">
					<button class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</button>
				</div>
				<input name="find" value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" type="text" class="form-control" placeholder="Tìm" aria-label="Search" aria-describedby="basic-addon1">
			</div>
		</form>
		<?php if (Auth::access('admin')) : ?>
			<div class="div">
				<a href="<?= ROOT ?>/students/export">
					<button class="btn btn-sm btn-primary"><i class="fa fa-download"></i>Xuất file excel</button>
				</a>
				<a href="<?= ROOT ?>/signup?mode=students">
					<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Thêm sinh viên</button>
				</a>
			</div>
		<?php endif; ?>
	</nav>

	<div class="card-group justify-content-center">

		<?php if ($rows) : ?>
			<?php foreach ($rows as $row) : ?>

				<?php include(views_path('users')) ?>

			<?php endforeach; ?>
		<?php else : ?>
			<h4>Không có học sinh nào được tìm thấy</h4>
		<?php endif; ?>
	</div>

	<?php $pager->display() ?>
</div>
<?php $this->view('includes/footer') ?>