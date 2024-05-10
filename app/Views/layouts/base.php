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
  <title><?= $this->renderSection("title"); ?> | Trans It!</title>
  <!-- CSS files -->
  <link href="<?= base_url("pack/css/tabler.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-flags.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-payments.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/tabler-vendors.min.css?1684106062") ?>" rel="stylesheet" />
  <link href="<?= base_url("pack/css/demo.min.css?1684106062") ?>" rel="stylesheet" />
  <link rel="shortcut icon" href="<?= base_url("img/logo.jpeg") ?>" type="image/x-icon">
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>

<body class=" d-flex flex-column">
  <script src="<?= base_url("pack/js/demo-theme.min.js?1684106062") ?>"></script>

  <?= $this->renderSection('content'); ?>

  <!-- Libs JS -->
  <!-- Tabler Core -->
  <script src="<?= base_url("pack/js/tabler.min.js?1684106062") ?>" defer></script>
  <script src="<?= base_url("pack/js/demo.min.js?1684106062") ?>" defer></script>
</body>

</html>