<?php @session_start();?>
<nav class=" d-flex align-items-center">
  <div class=" container ">
    <div class="row d-flex align-items-center  ">
      <div class="col-lg-2  d-flex align-items-center ">
        <h3 style="margin-top:10px;  font-weight:bold;">荻瑟特</h3>
      </div>
      <div class="col-lg-10 d-flex align-items-center justify-content-end">
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link" href="index.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="news.php">NEWS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=<?php echo (isset($_SESSION['id'])) ? ( "itemsBuy.php" ) : ( "items.php" ); ?>>ITEMS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">CONTACT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href=<?php echo (isset($_SESSION['id'])) ? ( "member.php" ) : ( "login.php" ); ?> >
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
              </svg>
            </a>
          </li>
          <?php if(isset($_SESSION['id'])){ ?>
            <li class="nav-item">
              <a class="nav-link" href="shoppingcart.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
<style scoped>
  nav {
    height: 80px;
    border-bottom: 1px solid black;
    color: #4f4f4f;
  }

  .nav-link {
    color: #4f4f4f;
  }

  .nav-item :hover {
    background-color: lightgray;
  }
</style>