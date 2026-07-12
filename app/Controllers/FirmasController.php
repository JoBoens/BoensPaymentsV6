<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Controllers/FirmasController.php
 * Versie  : 6.9.0
 * Doel    : CRUD Firma's
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\Firma;

class FirmasController extends Controller
{
    private Firma $firma;

    public function __construct()
    {
        $this->firma = new Firma();
    }

    /**
     * Overzicht
     */
    public function index(): void
    {
        View::render('firmas/index', [

            'title' => 'Firma\'s',

            'firmas' => $this->firma->all()

        ]);
    }

    /**
     * Nieuw
     */
    public function create(): void
    {
        View::render('firmas/create', [

            'title' => 'Nieuwe firma'

        ]);
    }

    /**
     * Opslaan
     */
    public function store(): void
    {
        $this->firma->create($_POST);

        header('Location: ' . url('firmas'));

        exit;
    }

    /**
     * Wijzigen
     */
    public function edit(int $id): void
    {
        View::render('firmas/edit', [

            'title' => 'Firma wijzigen',

            'firma' => $this->firma->find($id)

        ]);
    }
}