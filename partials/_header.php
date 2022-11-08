<?php
  session_start();
  include '_loginModal.php';
  $prefix= '';

  if(isset($_SESSION['userTYPE']) && $_SESSION['userTYPE']== 'admin'){
    $prefix= 'Admin, '. $_SESSION['adminNAME'];
  }

  if(isset($_SESSION['userTYPE']) && $_SESSION['userTYPE']== 'farmer'){
    $prefix= 'Farmer, '. $_SESSION['farmerNAME'];
  }
  if(isset($_SESSION['userTYPE']) && $_SESSION['userTYPE']== 'superadmin'){
    $prefix= 'Super Admin, '. $_SESSION['sadminNAME'];
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="breadcrumb">
  <div class="container-fluid">
    <a class="navbar-brand" href="/farm/index.php">ForFarmers!</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
          if (!isset($_GET['panel'])) {
            echo '<li class="nav-item">
                      <a class="nav-link" aria-current="page" href="#">Contact</a>
                    </li>';
          }
        ?>
      </ul>
      <?php
        if (isset($_GET['panel']) && $_GET['panel'] == 'farmer' && !isset($_SESSION['login']) && !isset($_SESSION['logIN'])){
          echo '<div class="d-flex">
                  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: white;">Log In</button>
                </div>';
        }

        if (isset($_GET['panel']) && $_GET['panel'] == 'admin' && !isset($_SESSION['login']) && !isset($_SESSION['logIN'])){
          echo '<div class="d-inline">
                  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal"
                  style="color: white;">Log In</button>
                </div>';
        }

        if(isset($_GET['panel']) && $_GET['panel']== 'admin' && isset($_SESSION['login']) && $_SESSION['login']== true && !isset($_SESSION['logIN'])){
          echo '<div class="d-inline-block user-select-none">
                  <span class="mx-2" style="color: #ffffff;">'.$prefix.'</span>
                  <button class="btn btn-danger"><a style="color: #ffffff; text-decoration: none;" href="_adminlogout.php">Log Out</a>
                  </button>
                </div>';
          }

        if(isset($_GET['panel']) && $_GET['panel']== 'farmer' && isset($_SESSION['login']) && $_SESSION['login']== true && !isset($_SESSION['logIN'])){
          echo '<div class="d-inline-block user-select-none">
                  <span class="mx-2" style="color: #ffffff;">'.$prefix.'</span>
                  <button class="btn btn-danger"><a style="color: #ffffff; text-decoration: none;" href="_farmerlogout.php">Log Out</a>
                  </button>
                </div>';
            }

        if(!isset($_GET['panel']) && isset($_SESSION['login']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'admin' && !isset($_SESSION['logIN'])){
          echo '<div class="d-inline-block user-select-none">
                  <span class="mx-2" style="color: #ffffff;">'.$prefix.'</span>
                  <button class="btn btn-danger"><a style="color: #ffffff; text-decoration: none;" href="partials/_adminlogout.php">Log Out</a>
                  </button>
                </div>';
        }
      
        if(!isset($_GET['panel']) && isset($_SESSION['login']) && $_SESSION['login']== true && $_SESSION['userTYPE']== 'farmer' && !isset($_SESSION['logIN'])){
          echo '<div class="d-inline-block user-select-none">
                  <span class="mx-2" style="color: #ffffff;">'.$prefix.'</span>
                  <button class="btn btn-danger"><a style="color: #ffffff; text-decoration: none;" href="partials/_farmerlogout.php">Log Out</a>
                  </button>
                </div>';
        }
        if(isset($_GET['panel']) && isset($_SESSION['logIN']) && isset($_SESSION['userTYPE']) && $_GET['panel']= 'admin' && $_SESSION['logIN']== true && $_SESSION['userTYPE']== 'superadmin'){
          echo '<div class="d-inline-block user-select-none">
                  <span class="mx-2" style="color: #ffffff;">'.$prefix.'</span>
                  <button class="btn btn-danger"><a style="color: #ffffff; text-decoration: none;" href="_superadminlogout.php">Log Out</a>
                  </button>
                </div>';
        }
      ?>
    </div>
  </div>
</nav>