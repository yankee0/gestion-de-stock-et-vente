<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture Nº<?= $ref ?></title>
  <link rel="shortcut icon" href="<?= base_url("img/logo.jpeg") ?>" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Fira Code", monospace;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
      text-align: center;

    }

    .invoice-container {
      padding-top: 30px;
      padding-bottom: 30px;
      max-width: 500px;
      margin: auto;
    }

    img {
      height: 100px;
      margin: auto;
    }

    table * {
      text-align: start;
    }

    table {
      border: solid 1px;
      width: 100%;
      border-collapse: collapse;
    }

    td,
    th {
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 10px;
      padding-right: 10px;
      border: solid 1px;
    }

    .no-wrap {
      text-wrap: nowrap;
    }

    button {
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 20px;
      padding-right: 20px;
      border: solid 1px;
      background: white;
      cursor: pointer;
      margin-left: auto;
      margin-right: auto;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="invoice-container">
    <img src="<?= base_url("img/logobw.png") ?>" alt="La Maison De Touba">
    <p>
      <strong>Contact</strong> <br>
      <span>77 704 92 52 - 78 330 71 71</span>
    </p>
    <h2>Facture Nº <?= $ref ?></h2>
    <table>
      <thead>
        <tr>
          <th width="50%">Désignation</th>
          <th width="10%">Qté</th>
          <th width="10%">P.U.</th>
          <th width="30%">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sales as $sale) : ?>
          <tr>
            <td><?= $sale["item_name"] ?></td>
            <td><?= $sale["quantity"] ?></td>
            <td><?= $sale["price_per_unit"] ?></td>
            <td><?= $sale["price_per_unit"] * $sale["quantity"] ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Total</th>
          <th><?= $sum ?> FCFA</th>
        </tr>
      </tfoot>
    </table>
    <p>Nous vous remercions pour votre confiance et votre fidélité. À bientôt :)</p>
    <small>Par Sen Digita Pulse</small><br>
    <small>https://sendigitalpulse.com</small>
  </div>
  <div class="no-print" style="margin-top:30px">
    <button onclick="window.print()">Imprimer la facture</button>
  </div>
</body>

</html>