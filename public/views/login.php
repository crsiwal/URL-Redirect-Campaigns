<?php
$content = [
  "title" => "Login to dashboard | Redirect Campaign Tool",
  "description" => "Login to dashboard for use",
  "keywords" => "login"
];
$error = (empty(session("error")) ? false : true);
?>
<?php include("header.php"); ?>
<main class="login">
  <div class="container">
    <div class="row align-items-center bg-white vh-100">
      <div class="col-12 col-md-6 m-auto card px-5 py-2">
        <h1 class="fs-2 mt-3">Login</h1>
        <p class="fs-6">Validate username and password to view restricted content.</p>
        <form action="<?= base_url("post/login"); ?>" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control <?= ($error) ? "is-invalid" : ""; ?>" id="username" placeholder="Username" name="u">
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control <?= ($error) ? "is-invalid" : ""; ?>" id="pwd" placeholder="Password" name="p">
            <div class="invalid-feedback">Invalid username or password</div>
          </div>
          <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary px-5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include("footer.php"); ?>