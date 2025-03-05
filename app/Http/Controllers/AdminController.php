<?php
namespace App\Http\Controllers;
use App\Models\User;
use Inertia\Inertia;
class AdminController extends Controller
{
    public function getFormateursEnAttente()
    {
        // Récupérer tous les formateurs avec le statut 'en_attente'
        $formateurs = User::where('role', 'formateur')
                          ->where('status', 'en_attente')
                          ->get();

        // Retourner les données à Inertia
        return Inertia::render('FormateurEnAttente', [
            'formateurs' => $formateurs
        ]);
    }
}
