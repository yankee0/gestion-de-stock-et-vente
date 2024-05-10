<?= $this->extend('layouts/app'); ?>
<?= $this->section('title'); ?>
Factures
<?= $this->endSection(); ?>
<?= $this->section('h1'); ?>
<h1>Factures</h1>
<?= $this->endSection(); ?>
<?= $this->section('add'); ?>
<a class="btn btn-success" href="<?= base_url("factures/creer") ?>" role="button">Nouvelle facture</a>

<?= $this->endSection(); ?>


<?= $this->section('cols'); ?>

<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="card-title"><?= isset($_GET["r"]) ? "Résultat: " : "Liste des factures du mois: " ?><?= count($items) ?> factures(s)</div>
      <div class="d-flex justify-content-end">
        <form action="#">
          <div class="mb-3">
            <input type="text" class="form-control" name="r" value="<?= $_GET["r"] ?? "" ?>" placeholder="Rechercher" />
          </div>
        </form>

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
            <?php foreach ($items as $item) : ?>
              <tr>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn text-danger" onclick='del(<?= $item["id"] ?>)'><i class="ti ti-trash"></i></button>
                  </div>
                </td>
                <td><?= $item["ref"] ?></td>
                <td><?= $item["created_at"] ?></td>
                <td><?= $item["sum"] ?></td>
                <td><?= $item["by"] ?></td>
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