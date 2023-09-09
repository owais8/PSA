
<?php 

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>
<nav class="navbar navbar-expand-md bg-body-tertiary">
  <div class="container-xl">
    <a class="navbar-brand" href="#">
      <img src="assets/logo.jpg" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="orders.php">My Grading Order</a>
        </li>
        <li class="nav-item ">
        <a class="nav-link" aria-current="page" href="card-submission.php">Add New Grading Order</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="profile.php">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      <div class="search-and-icons">
        <form class="d-flex mb-2 me-2" role="search">
          <input class="form-control me-2" type="search" aria-label="Search">
        </form>
        <div class="user-icons d-flex mb-2">
          <div class="profile"><i class="bi bi-person"></i></div>
          <div class="wishlist"><i class="bi bi-heart"></i></div>
          <div class="cart"><i class="bi bi-cart3"></i></div>
        </div>
      </div>
      <div class="contact-info d-md-flex">
        <p>+0987654321 | +1234567890 </p>
        <p><a href="mailto:">contact@domainname.com</a></p>
      </div>
    </div>
  </div>
</nav>
<br>
<br>
<br>