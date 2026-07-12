<?php
declare(strict_types=1);

$config = require __DIR__ . '/../../config/app.php';

ob_start();
?>

<div class="page-header">

    <div>
        <h1>Nieuwe betaling</h1>
        <p>Voeg een nieuwe betaling toe.</p>
    </div>

</div>

<form method="post"
      action="store.php"
      enctype="multipart/form-data">

<div class="card shadow-sm mb-4">

<div class="card-header">
<strong>Algemeen</strong>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-3 mb-3">
<label class="form-label">Nummer</label>
<input type="text" class="form-control" value="260001" readonly>
</div>

<div class="col-md-5 mb-3">
<label class="form-label">Firma</label>
<select class="form-select">
<option>-- Kies firma --</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label class="form-label">Categorie</label>
<select class="form-select">
<option>-- Kies categorie --</option>
</select>
</div>

</div>

<div class="row">

<div class="col-md-8 mb-3">
<label class="form-label">Omschrijving</label>
<input type="text" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label class="form-label">Referentie</label>
<input type="text" class="form-control">
</div>

</div>

</div>

</div>

<div class="card shadow-sm mb-4">

<div class="card-header">
<strong>Factuur</strong>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-3 mb-3">
<label>Factuurdatum</label>
<input type="date" class="form-control">
</div>

<div class="col-md-3 mb-3">
<label>Vervaldatum</label>
<input type="date" class="form-control">
</div>

<div class="col-md-3 mb-3">
<label>Betaaldatum</label>
<input type="date" class="form-control">
</div>

<div class="col-md-3 mb-3">
<label>Bedrag (€)</label>
<input type="number" step="0.01" class="form-control">
</div>

</div>

</div>

</div>

<div class="card shadow-sm mb-4">

<div class="card-header">
<strong>Extra informatie</strong>
</div>

<div class="card-body">

<div class="mb-3">

<label>Opmerkingen</label>

<textarea
class="form-control"
rows="5"></textarea>

</div>

</div>

</div>

<div class="card shadow-sm mb-4">

<div class="card-header">
<strong>Document</strong>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label class="form-label">

Factuur of document

</label>

<input
type="file"
class="form-control"
accept=".pdf,image/*">

</div>

<div class="col-md-6">

<label class="form-label">

Mobiel scannen / foto nemen

</label>

<input
type="file"
class="form-control"
accept="image/*"
capture="environment">

</div>

</div>

</div>

</div>

<div class="d-flex gap-2">

<button class="btn btn-primary">

Opslaan

</button>

<a
href="index.php"
class="btn btn-secondary">

Annuleren

</a>

</div>

</form>

<?php

$content = ob_get_clean();

require __DIR__.'/../../includes/layout.php';