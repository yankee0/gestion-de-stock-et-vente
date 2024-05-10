<?= $this->extend('layouts/app'); ?>
<?= $this->section('title'); ?>
Rapports
<?= $this->endSection(); ?>
<?= $this->section('h1'); ?>
<h1>Rapport</h1>
<?= $this->endSection(); ?>

<?= $this->section('cols'); ?>

<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        Formulaire d'ajout
      </div>
      <div>
        <form action="#">
          <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-3">
              <div class="mb-3">
                <label for="from" class="form-label">Début</label>
                <input value="<?= $_GET["from"] ?? date("Y-m-01 08:00") ?>" required type="datetime-local" class="form-control" name="from" id="from" />
              </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3">
              <div class="mb-3">
                <label for="to" class="form-label">Fin</label>
                <input value="<?= $_GET["to"] ?? date("Y-m-d 17:00") ?>" required type="datetime-local" class="form-control" name="to" id="to" />
              </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-3">
              <div class="mb-3">
                <label for="by" class="form-label">Auteur</label>
                <select class="form-select " name="by" id="by">
                  <option value="all">Tous</option>
                  <?php foreach ($users as $user) : ?>
                    <option <?= (($_GET["by"] ?? "") == $user["id"]) ? "selected" : "" ?> value="<?= $user['id'] ?>"><?= $user["name"] ?> - <?= $user["profile"] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

            </div>

            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary">
                Générer le rapport
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="card-title"><?= isset($_GET["from"]) ? "Résultat: " : "Liste des factures du mois: " ?><?= count($invoices) ?> factures(s)</div>
      <div class="text-center mb-3">
        <?php
        $sum = 0;
        foreach ($invoices as $i) {
          $sum += $i["sum"];
        }
        ?>

        <h4>Total</h4>
        <div class="display-4"><?= $sum ?> FCFA</div>
      </div>
      <div class="table-responsive card-table">
        <table class="table table-vcenter">
          <thead>
            <tr>
              <th></th>
              <th>Référence</th>
              <th>Date de création</th>
              <th>Montant Total</th>
              <th>Auteur</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($invoices as $invoice) : ?>
              <tr>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn text-danger" onclick='del(<?= $invoice["id"] ?>)'><i class="ti ti-trash"></i></button>
                  </div>
                </td>
                <td><?= $invoice["ref"] ?></td>
                <td><?= $invoice["created_at"] ?></td>
                <td><?= $invoice["sum"] ?></td>
                <td><?= $invoice["by"] ?></td>
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
<script>
  function del(id) {
    if (confirm("Voulez vous vraiment supprimer cette facture? Les ventes seront automatiquement restutuées aux stocks de produits.")) {
      window.location = "<?= base_url('factures/supprimer/') ?>" + id
    };
  }

  function setEdit(data) {
    document.getElementById("edit_id").value = data.id;
    document.getElementById("edit_name").value = data.name;
    document.getElementById("edit_quantity").value = data.quantity;
    document.getElementById("edit_price_per_unit").value = data.price_per_unit;
  }
</script>
<?= $this->endSection(); ?>