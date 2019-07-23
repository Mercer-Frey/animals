<?php require_once('/template/header_login.php');?>
<div class="container">
    <div class="row">
    <div class="col-lg-4 offset-4">
        <?php echo $flash?>
        <h4 class='text-danger text-center'><?php echo $danger;?></h4>
    <h2>Login</h2>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="marc.Liciniy@crass">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="12345">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>
</div>
<?php require_once('template/footer.php');?>