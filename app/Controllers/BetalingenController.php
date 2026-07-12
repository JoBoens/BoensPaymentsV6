<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Controllers/BetalingenController.php
 * Versie  : 6.4.0
 * Doel    : Controller Betalingen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Betaling;
use Throwable;

class BetalingenController extends Controller
{
    /**
     * Betaling Model
     */
    private Betaling $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new Betaling();
    }

    /**
     * Overzicht betalingen
     */
    public function index(): void
    {
        $this->render('betalingen/index', [
            'title'       => 'Betalingen',
            'betalingen'  => $this->model->all()
        ]);
    }

    /**
     * Formulier nieuwe betaling
     */
    public function create(): void
    {
        $db = Database::connection();

        /*
        |--------------------------------------------------------------------------
        | Nieuw betalingsnummer bepalen
        |--------------------------------------------------------------------------
        */

        $jaar = date('y');

        $stmt = $db->prepare("
            SELECT nummer
            FROM betalingen
            WHERE nummer LIKE :prefix
            ORDER BY nummer DESC
            LIMIT 1
        ");

        $stmt->execute([
            'prefix' => $jaar . '%'
        ]);

        $laatste = $stmt->fetchColumn();

        $volgnummer = $laatste
            ? ((int) substr($laatste, 2)) + 1
            : 1;

        $nummer = sprintf('%02d%04d', $jaar, $volgnummer);

        /*
        |--------------------------------------------------------------------------
        | Firma's
        |--------------------------------------------------------------------------
        */

        $firmas = $db->query("
            SELECT id, naam
            FROM firmas
            WHERE actief = 1
            ORDER BY naam
        ")->fetchAll();

        /*
        |--------------------------------------------------------------------------
        | Categorieën
        |--------------------------------------------------------------------------
        */

        $categorieen = $db->query("
            SELECT id, naam
            FROM categorieen
            WHERE actief = 1
            ORDER BY naam
        ")->fetchAll();

        $this->render('betalingen/create', [
            'title'        => 'Nieuwe betaling',
            'nummer'       => $nummer,
            'firmas'       => $firmas,
            'categorieen'  => $categorieen
        ]);
    }

    /**
     * Nieuwe betaling opslaan
     */
    public function store(): void
    {
        $data = [

            'nummer'         => trim($_POST['nummer'] ?? ''),
            'firma_id'       => (int) ($_POST['firma_id'] ?? 0),
            'categorie_id'   => (int) ($_POST['categorie_id'] ?? 0),
            'omschrijving'   => trim($_POST['omschrijving'] ?? ''),
            'factuurnummer'  => trim($_POST['factuurnummer'] ?? ''),
            'factuurdatum'   => $_POST['factuurdatum'] ?? '',
            'vervaldatum'    => $_POST['vervaldatum'] ?? '',
            'bedrag'         => (float) ($_POST['bedrag'] ?? 0),
            'status'         => $_POST['status'] ?? 'Open'

        ];

        try {

            $this->model->create($data);

            $this->redirect('betalingen');

        } catch (Throwable $e) {

            $this->abort500($e->getMessage());

        }
    }

    /**
     * Formulier wijzigen
     */
    public function edit(int $id): void
    {
        $betaling = $this->model->find($id);

        if (!$betaling) {
            $this->abort404('Betaling niet gevonden.');
        }

        $this->render('betalingen/edit', [
            'title'     => 'Betaling wijzigen',
            'betaling'  => $betaling
        ]);
    }

    /**
     * Betaling bijwerken
     */
    public function update(int $id): void
    {
        try {

            $this->model->update($id, $_POST);

            $this->redirect('betalingen');

        } catch (Throwable $e) {

            $this->abort500($e->getMessage());

        }
    }

    /**
     * Betaling verwijderen
     */
    public function delete(int $id): void
    {
        try {

            $this->model->delete($id);

            $this->redirect('betalingen');

        } catch (Throwable $e) {

            $this->abort500($e->getMessage());

        }
    }
}