<?PHP require_once 'template/header_signup.php';?>

<div class="container">
    <div class="row">
    <div class="col-lg-4 offset-4">
        <h4 class='text-danger text-center'><?php echo $danger;?></h4>
    <h2>Sign Up</h2>
    <form method="POST">
        <div class="form-group">
            <label>Login</label>
            <input type="login" class="form-control" aria-describedby="loginHelp" placeholder="Enter login" name="login">
            <small id="loginHelp" class="form-text text-muted">The alias field must be between 4 and 10 characters.</small>
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" aria-describedby="passwordOne" placeholder="Password" name="pass">
            <small id="passwordOne" class="form-text text-muted">Password field must be from 6 to 20 characters.</small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" aria-describedby="passwordTwo" placeholder="Password" name="repass">
            <small id="passwordTwo" class="form-text text-muted">Repeat your password.</small>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">I have read and understood <a href="/rules" target="_blank">the rules</a> of the project:
            <input type="checkbox" class="form-check-input" name="rules">
            </label>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
    </div>
    </div>
</div>

<?php require_once('template/footer.php');?>