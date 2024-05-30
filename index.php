<?php
include 'includes/header.php';

session_start();

if (!empty($_SESSION['user_id'])) {
    header("Location: dashboard.php");
}
?>

<section class="sr-section">
  <div class="sr-card login-card sr-position-center">
    <h3 class="sr-card-title">Login</h3>
    <p class="text-secondary sr-card-subtitle">Enter your email and password</p>

  <form class="form-area pb-4" action="" method="post">
    <div class="input">
      <label for="email">email</label>
      <input type="email" name="email">
    </div>
    <div class="input">
      <label for="pass">Password</label>
      <input type="password" name="pass">
    </div>
    <div class="text-center">
      <input type="submit" value="Login">
    </div>
  </form>

  <div class="">
    <a href="register.php" class='icon-link icon-link-hover'>Create account ?</a>
  </div>
  </div>
</section>

<?php
include 'includes/footer.php'
?>