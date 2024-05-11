<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title><?= $this->renderSection("title"); ?> | La Maison De Touba</title>
  <!-- CSS files -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
  <link href="<?= base_url("pack/css/tabler.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-flags.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-payments.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-vendors.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/demo.min.css?1684106062") ?>" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="shortcut icon" href="<?= base_url("img/logo.jpeg") ?>" type="image/x-icon">
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }

    i.ti {
      font-size: 18px;
    }

    #toastContainer {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 100;
      width: fit-content;
      max-width: 500px;
    }
  </style>
</head>

<body>
  <script src="./dist/js/demo-theme.min.js?1684106062"></script>
  <div class="page">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href="<?= base_url("tableau-de-bord") ?>">
            <img src="<?= base_url("img/logo.jpeg") ?>" alt="Tabler" class="navbar-brand-image">
          </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          <div class="nav-item d-none d-md-flex me-3">
            <div class="btn-list">
              <a href="mailto:yankee@sendigitalpulse.com" class="btn d-flex gap-2 align-items-center" target="_blank" rel="noreferrer">
                <i class="ti ti-headset"></i>
                <span>Support</span>
              </a>
            </div>
          </div>

          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0 btn d-flex gap-2 align-items-center px-1" data-bs-toggle="dropdown" aria-label="Open user menu">
              <i class="ti ti-user"></i>
              <div class="text-start">
                <small class="text-primary"><?= session()->user["profile"] ?></small> <br>
                <?= session()->user["name"] ?>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <!-- <a href="#" class="dropdown-item btn d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#modalIdResetPassword"><i class="ti ti-lock"></i> Modifier mon mot de passe</a> -->
              <a href="mailto:yankee@sendigitalpulse.com" class="dropdown-item d-flex gap-2 align-items-center"><i class="ti ti-headset"></i> Support</a>
              <a href="<?= base_url("deconnexion") ?>" class="dropdown-item d-flex gap-2 align-items-center"><i class="ti ti-power"></i> Se déconnecter</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <header class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
          <div class="container-xl">
            <ul class="navbar-nav">
              <li class="nav-item <?= url_is("tableau-de-bord*") ? "active" : "" ?>">
                <a class="nav-link d-flex align-items-center" href="<?= base_url("tableau-de-bord") ?>">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-dashboard"></i>
                  </span>
                  <span class="nav-link-title">
                    Tableau de bord
                  </span>
                </a>
              </li>

              <?php if (in_array(session()->user["profile"], ["ADMIN"])) : ?>
                <li class="nav-item <?= url_is("utilisateurs*") ? "active" : "" ?>">
                  <a class="nav-link d-flex align-items-center" href="<?= base_url("utilisateurs") ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <i class="ti ti-users"></i>
                    </span>
                    <span class="nav-link-title">
                      Utilisateurs
                    </span>
                  </a>
                </li>
                <li class="nav-item <?= url_is("inventaire*") ? "active" : "" ?>">
                  <a class="nav-link d-flex align-items-center" href="<?= base_url("inventaire") ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <i class="ti ti-clipboard-list"></i>
                    </span>
                    <span class="nav-link-title">
                      Inventaire
                    </span>
                  </a>
                </li>
              <?php endif ?>


              <li class="nav-item <?= url_is("factures*") ? "active" : "" ?>">
                <a class="nav-link d-flex align-items-center" href="<?= base_url("factures") ?>">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <i class="ti ti-file"></i>
                  </span>
                  <span class="nav-link-title">
                    Factures
                  </span>
                </a>
              </li>

              <?php if (in_array(session()->user["profile"], ["ADMIN"])) : ?>
                <li class="nav-item dropdown <?= url_is("rapports*") ? "active" : "" ?>">
                  <a class="nav-link d-flex align-items-center" href="<?= base_url("rapports") ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <i class="ti ti-archive"></i>
                    </span>
                    <span class="nav-link-title">
                      Rapports
                    </span>
                  </a>
                </li>
              <?php endif ?>

            </ul>

          </div>
        </div>
      </div>
    </header>
    <div class="page-wrapper">
      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <?= $this->renderSection('breadcrumb'); ?>
            <div class="col-12">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Page
              </div>
              <h2 class="page-title">
                <?= $this->renderSection('h1'); ?>
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <?= $this->renderSection("add"); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-deck row-cards">
            <?= $this->renderSection('cols'); ?>
          </div>
        </div>
      </div>
      <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
          <div class="row text-center align-items-center flex-row-reverse">

            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  &copy; 2024 La Maison De Touba par <a href="https://sendigitalpulse.com" target="_blank">SDP</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>




  <div id="toastContainer">
    <?php if (session()->has("message")) : ?>
      <div class="w-100 alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Succès!</strong> <?= session()->message ?>
      </div>
    <?php endif ?>

    <?php if (session()->has("error")) : ?>
      <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Erreur!</strong> <?= session()->error ?>
      </div>
    <?php endif ?>
  </div>

  <!-- Tabler Core -->
  <script src="<?= base_url("pack/js/tabler.min.js?1684106062") ?>" defer></script>
  <script src="<?= base_url("pack/js/demo.min.js?1684106062") ?>" defer></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.min.js"></script>
  <?= $this->renderSection('js'); ?>
</body>

</html>