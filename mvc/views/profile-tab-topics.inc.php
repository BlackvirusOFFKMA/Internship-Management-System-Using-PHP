<center><h4>Đề tài</h4></center>
<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
      </div>
      <input type="text" class="form-control" placeholder="Tìm" aria-label="Search" aria-describedby="basic-addon1">
    </div>
  </form>
</nav>
 
<hr>
<?php $rows = $student_topics;?>
<?php include(views_path('topics'))?>

