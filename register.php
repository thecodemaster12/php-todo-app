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
    <p class="text-secondary sr-card-subtitle">Fill out all the field</p>

  <form class="form-area pb-3" action="includes/add-user.php" method="post">
    <div class="input">
      <label for="name">Full Name</label>
      <input type="text" name="name">
    </div>
    <div class="input">
      <label for="email">email</label>
      <input type="email" name="email">
    </div>
    <div class="input">
      <label for="pass">Password</label>
      <input type="password" name="pass">
    </div>
    <div class="input">
      <label for="pass">Confirm Password</label>
      <input type="password" name="confPass">
    </div>
    <div class="text-center">
      <input type="submit" value="Create">
    </div>
  </form>

  <div class="text-center text-danger py-2">
    <p><?php
        if (!empty($_SESSION['reg-status'])) {
            echo $_SESSION['reg-status'];
            unset($_SESSION['reg-status']);
        }
    ?></p>
  </div>

  <div class="">
    <a href="index.php" class='icon-link icon-link-hover'>Login ?</a>
  </div>
  </div>
</section>

<?php
include 'includes/footer.php'
?>