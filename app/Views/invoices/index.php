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
                    <button class="btn" onclick='setEdit(<?= json_encode($item) ?>)' data-bs-toggle="modal" data-bs-target="#edit"><i class="ti ti-edit"></i></button>
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
<div class="modal fade" id="edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTitle">
          Modification
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="edit_form" action="<?= base_url("inventaire/modifier") ?>" method="post">

          <?= csrf_field() ?>
          <input type="text" name="id" id="edit_id" hidden>
          <div>
            <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input value="<?= set_value("name") ?>" required type="text" class="form-control" name="name" id="edit_name" />
            </div>
          </div>
          <div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantité (en Kg ou en Unité)</label>
              <input value="<?= set_value("quantity") ?>" required type="number" class="form-control" name="quantity" id="edit_quantity" min="0" />
            </div>
          </div>
          <div>
            <div class="mb-3">
              <label for="price_per_unit" class="form-label">Prix par Kg ou Unité</label>
              <input value="<?= set_value("price_per_unit") ?>" required type="number" min="0" minlength="5" class="form-control" name="price_per_unit" id="edit_price_per_unit" />
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Fermer
        </button>
        <button form="edit_form" type="submit" class="btn btn-primary">Modifier</button>
      </div>
    </div>
  </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
  const myModal = new bootstrap.Modal(
    document.getElementById("edit"),
    options,
  );
</script>



<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
  function del(id) {
    if (confirm("Voulez vous vraiment supprimer cette facture? cette action je la comptabilisée dans les chiffres d'affaires!")) {
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