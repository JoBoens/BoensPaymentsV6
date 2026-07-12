<?php
declare(strict_types=1);
$title='Nieuwe betaling';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
<div><h2>Nieuwe betaling</h2><small class="text-muted">Voeg een nieuwe betaling toe</small></div>
<a href="index.php" class="btn btn-outline-secondary">Terug</a>
</div>
<form method="post" action="store.php" enctype="multipart/form-data">
<?= csrfField(); ?>
<div class="card shadow-sm mb-4"><div class="card-header"><strong>Algemeen</strong></div><div class="card-body">
<div class="row g-3">
<div class="col-md-3"><label class="form-label">Betalingsnummer</label><input class="form-control" name="nummer" value="<?= e($nummer) ?>" readonly></div>
<div class="col-md-5"><label class="form-label">Firma *</label><select class="form-select" name="firma_id" required><option value="">-- Kies een firma --</option><?php foreach($firmas as $firma): ?><option value="<?= (int)$firma['id'] ?>"><?= e($firma['naam']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-4"><label class="form-label">Categorie</label><select class="form-select" name="categorie_id"><option value="">-- Kies een categorie --</option><?php foreach($categorieen as $categorie): ?><option value="<?= (int)$categorie['id'] ?>"><?= e($categorie['naam']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-6"><label class="form-label">Omschrijving *</label><input class="form-control" name="omschrijving" required></div>
<div class="col-md-3"><label class="form-label">Leveranciersfactuur</label><input class="form-control" name="leverancier_factuurnummer"></div>
<div class="col-md-3"><label class="form-label">Referentie</label><input class="form-control" name="referentie"></div>
</div></div></div>
<div class="card shadow-sm mb-4"><div class="card-header"><strong>Factuurgegevens</strong></div><div class="card-body"><div class="row g-3">
<div class="col-md-3"><label>Factuurdatum *</label><input type="date" class="form-control" name="factuurdatum" value="<?= date('Y-m-d') ?>" required></div>
<div class="col-md-3"><label>Vervaldatum</label><input type="date" class="form-control" name="vervaldatum"></div>
<div class="col-md-3"><label>Betaaldatum</label><input type="date" class="form-control" name="betaaldatum"></div>
<div class="col-md-3"><label>Bedrag (€)</label><input type="number" step="0.01" min="0" class="form-control" name="bedrag" required></div>
<div class="col-md-4"><label>Status</label><select class="form-select" name="status"><option>Open</option><option>Betaald</option><option>Achterstallig</option><option>Geannuleerd</option></select></div>
</div></div></div>
<div class="card shadow-sm mb-4"><div class="card-header"><strong>Opmerkingen</strong></div><div class="card-body"><textarea class="form-control" rows="6" name="opmerkingen"></textarea></div></div>
<div class="card shadow-sm mb-4"><div class="card-header"><strong>Document</strong></div><div class="card-body"><div class="row g-3">
<div class="col-md-6"><label>Upload document</label><input type="file" class="form-control" name="document" accept=".pdf,.jpg,.jpeg,.png,.webp"></div>
<div class="col-md-6"><label>Foto nemen (mobiel)</label><input type="file" class="form-control" name="camera" accept="image/*" capture="environment"></div>
</div></div></div>
<div class="d-flex justify-content-end gap-2 mb-5"><a href="index.php" class="btn btn-secondary">Annuleren</a><button type="submit" class="btn btn-primary">Opslaan</button></div>
</form>
