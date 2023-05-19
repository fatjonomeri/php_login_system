<?php
include "header.php";
if (!isset($_SESSION['first_name'])) {
    header("Location: index.php");
    exit();
}
?>

<body>
<nav class="navbar navbar-expand-lg navbar-dark nav-bg-custom">
    <span class="navbar-brand col-md-3 border-end">Welcome <?php echo $_SESSION['first_name'] ?></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-fluid">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php
        if ($_SESSION['roli']=='admin')
            echo '
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="navbar-brand" href="lista.php">Lista userave</a>
              </li>
              </ul>'
    ?>
    <a href="logout.php" class="btn btn-logout mt-0">Logout</a>
    </div>
  </div>
</nav>