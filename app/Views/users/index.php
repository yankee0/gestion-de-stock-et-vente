<?= $this->extend('layouts/app'); ?>
<?= $this->section('title'); ?>
Connexion
<?= $this->endSection(); ?>
<?= $this->section('h1'); ?>
<h1>Utilisateurs</h1>
<?= $this->endSection(); ?>

<?= $this->section('cols'); ?>
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        Formulaire de création
      </div>
      <div>
        <?= form_open() ?>
        <?= csrf_field() ?>
        <div class="row">
          <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input value="<?= set_value("name") ?>" required type="text" class="form-control" name="name" id="name" placeholder="John Ndiaye" />
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label for="login" class="form-label">Login</label>
              <input value="<?= set_value("login") ?>" required type="text" class="form-control" name="login" id="login" placeholder="jndiaye" />
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label for="profile" class="form-label">Profil</label>
              <select class="form-select " name="profile" id="profile">
                <option <?= set_select("profile", "CAISSE") ?>>Caissier</option>
                <option <?= set_select("profile", "CAISSE") ?> value="ADMIN">Administrateur</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input value="<?= set_value("password") ?>" required type="text" minlength="5" class="form-control" name="password" id="password" placeholder="Créez un mot de passe" />
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">
              Créer l'utilisateur
            </button>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="col-12">
  <div class="card">
    <div class="card-body">
      <div class="card-title"><?= isset($_GET["r"]) ? "Résultat: " : "Liste des utilisateurs: " ?><?= count($users) ?> utilisateur(s)</div>
      <div class="table-responsive card-table">
        <table id="myTable" class="table table-vcenter">
          <thead>
            <tr>
              <th></th>
              <th>Nom</th>
              <th>Login</th>
              <th>Profil</th>
              <th>Date de création</th>
              <th>Dernière modification</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td>
                  <div class="d-flex gap-2"><button class="btn text-danger" onclick="del(<?= $user['id'] ?>)"><i class="ti ti-trash"></i></button></div>
                </td>
                <td><?= $user["name"] ?></td>
                <td><?= $user["login"] ?></td>
                <td><?= $user["profile"] ?></td>
                <td data-order="<?= strtotime($user["created_at"]) ?>"><?= $user["created_at"] ? date("d/m/Y H:i:s", strtotime($user["created_at"])) : "-" ?></td>
                <td data-order="<?= strtotime($user["updated_at"]) ?>"><?= $user["updated_at"] ? date("d/m/Y H:i:s", strtotime($user["updated_at"])) : "-" ?></td>
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
    if (confirm("Voulez vous vraiment supprimer cette utilisateur?")) {
      window.location = "<?= base_url('utilisateurs/supprimer/') ?>" + id
    };
  }
</script>
<?= $this->endSection(); ?>