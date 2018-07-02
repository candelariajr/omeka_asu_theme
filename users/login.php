<?php
queue_js_file('login');
$pageTitle = __('Log In');
echo head(array('bodyclass' => 'login', 'title' => $pageTitle), $header);
?>
<?php echo flash(); ?>

<div class="container">
    <form class="form-signin" enctype="application/x-www-form-urlencoded" method="post" action="<?php echo CURRENT_BASE_URL?>/users/login">
        <h1 class="h3 mb-3 font-weight-normal">Sign in to Omeka</h1>
        <label for="inputUsername">Username</label>
        <input type="text" class="form-control" id="inputUsername" placeholder="Username" required autofocus name="username">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password" required name="password">
        <div class="checkbox mb-3"><label><input type="checkbox" value="remember-me">Remember me</label></div>
        <div>
            <input type="submit" name="submit" value="Log In">
        </div>
        <p id="forgotpassword">
            <?php echo link_to('users', 'forgot-password', __('(Lost your password?)')); ?>
        </p>
    </form>
</div>


<?php echo foot(array(), $footer); ?>
