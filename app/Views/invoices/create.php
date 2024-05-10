<?= $this->extend('layouts/app'); ?>
<?= $this->section('title'); ?>
Factures
<?= $this->endSection(); ?>
<?= $this->section('breadcrumb'); ?>
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="<?= base_url("factures") ?>">Factures</a>
  <span class="breadcrumb-item active" aria-current="page">Créer</span>
</nav>
<?= $this->endSection(); ?>

<?= $this->section('h1'); ?>
<h1>Factures</h1>
<?= $this->endSection(); ?>
<?= $this->section('cols'); ?>

<div class="col-12" id="module">

</div>



<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script src="<?= base_url("index.js") ?>" type="text/babel"></script>
<?= $this->endSection(); ?>