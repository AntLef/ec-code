<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Cod'Flix</title>
    <?= setlocale(LC_TIME, "fr_FR"); ?>

    <link href="public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="public/lib/font-awesome/css/all.min.css" rel="stylesheet" />

    <link href="public/css/partials/partials.css" rel="stylesheet" />
    <link href="public/css/layout/layout.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>


  <body>
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar">
        <h2 class="title">Bienvenue</h2>
        <div class="sidebar-menu">
          <ul>
            <li class="<?= !isset( $_GET['action'] ) ? "active" : ""; ?>"><a href="/">Médias</a></li>
            <li><a href="index.php?action=contact">Nous contacter</a></li>
            <li class="<?= ( isset( $_GET['action'] ) && !strcmp( $_GET['action'], "profile" ) ) ? "active" : ""; ?>"><a href="index.php?action=profile">Mon profile</a></li>
            <li class="<?= ( isset( $_GET['action'] ) && !strcmp( $_GET['action'], "history" ) ) ? "active" : ""; ?>"><a href="index.php?action=history">Mon historique</a></li>
            <li><a href="index.php?action=logout">Me déconnecter</a></li>
          </ul>
        </div>
      </nav>

      <!-- Page Content  -->
      <div id="content">
        <div class="header">
          <h2 class="title">Cod<span>'Flix</span></h2>
          <div class="toggle-menu d-block d-md-none">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fas fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
          </div>
        </div>
        <div class="content p-4">
          <?= $content; ?>
        </div>
        <footer>Copyright Cod'Flix</footer>
      </div>
    </div>

    <script src="public/lib/jquery/js/jquery-3.5.0.min"></script>
    <script src="public/lib/bootstrap/js/bootstrap.min.js"></script>

    <script src="public/js/script.js"></script>

  </body>

</html>
