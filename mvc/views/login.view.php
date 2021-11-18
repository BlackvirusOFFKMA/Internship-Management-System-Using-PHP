<?php $this->view('includes/header') ?>

    <div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="user">Username</label>
                <input id="user" class="form-control" type="text" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php $this->view('includes/footer') ?>