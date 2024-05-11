<?= $this->extend('layouts/app'); ?>
<?= $this->section('title'); ?>
Tableau de bord
<?= $this->endSection(); ?>

<?= $this->section('h1'); ?>
Tableau de bord
<?= $this->endSection(); ?>
<?= $this->section('add'); ?>
<a class="btn btn-success" href="<?= base_url("factures/creer") ?>" role="button">Nouvelle facture</a>
<a class="btn btn-info" href="<?= base_url("rapports") ?>" role="button">Rapports</a>
<?= $this->endSection(); ?>
<?= $this->section('cols'); ?>
<div class="col-12 text-center">
  <div class="mx-auto">
    <h3 class="text-center mx-auto">Ventes journalières</h3>
    <div class="display-4"><?= $dailySales["sum"] ?> FCFA</div>
  </div>
</div>
<div class="col-sm-6 col-lg-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div class="subheader">Ventes hebdomadaires</div>
      </div>
      <div class="h1 text-primary"><?= $weeklySales["sum"] ?? "0" ?> FCFA</div>
    </div>
  </div>
</div>
<div class="col-sm-6 col-lg-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div class="subheader">Ventes mensuelles</div>
      </div>
      <div class="h1 text-primary"><?= $monthlySales["sum"] ?> FCFA</div>
    </div>
  </div>
</div>
<div class="col-sm-6 col-lg-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div class="subheader">Ventes annuelles</div>
      </div>
      <div class="h1 text-primary"><?= $annualSales["sum"] ?> FCFA</div>
    </div>
  </div>
</div>
<div class="col-sm-6 col-lg-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div class="subheader">Nombre d'utilisateurs</div>
      </div>
      <div class="h1 text-primary"><?= $userCount ?></div>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
      <div class="card-title">Évolution des ventes de l'année <span class="text-primary"><?= date("Y") ?></span></div>
      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>
<div class="col-md-6 d-flex">
  <div class="card flex-fill">
    <div class="card-body">
      <div class="card-title">Stocks épuisés</div>
      <div class="table-responsive">
        <table class="table table-vcenter ">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Nom du produit</th>
              <th scope="col">Quantité</th>
              <th scope="col">Prix unitaire</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($outOfStocks as $o) : ?>
              <tr>
                <td><a class="btn btn-primary btn-sm" href="<?= base_url("inventaire?r=" . urlencode($o["name"])) ?>"><i class="ti ti-link"></i></a></td>
                <td><?= $o["name"] ?></td>
                <td><?= $o["quantity"] ?></td>
                <td><?= $o["price_per_unit"] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Janvier', 'Fèvrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', "Août", "Septembre", 'Octobre', 'Novembre', 'Décembre'],
      datasets: [{
        label: 'Total vente',
        data: <?= $lineData ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<?= $this->endSection(); ?>