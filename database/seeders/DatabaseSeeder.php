<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\Materiel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name'     => 'Administrateur',
            'email'    => 'admin@gim.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Create Regular User
        $user = User::create([
            'name'     => 'Jean Dupont',
            'email'    => 'user@gim.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Create sample materiels
        $materiels = [
            ['nom' => 'Ordinateur Portable Dell', 'numero_serie' => 'SN-2024-0001', 'categorie' => 'Informatique', 'localisation' => 'Bureau 12', 'etat' => 'bon', 'marque' => 'Dell', 'date_achat' => '2023-01-15', 'responsable' => 'Jean Dupont'],
            ['nom' => 'Imprimante HP LaserJet', 'numero_serie' => 'SN-2024-0002', 'categorie' => 'Informatique', 'localisation' => 'Salle Impression', 'etat' => 'a_verifier', 'marque' => 'HP', 'date_achat' => '2022-06-10', 'responsable' => 'Marie Martin'],
            ['nom' => 'Perceuse Bosch 18V', 'numero_serie' => 'SN-2024-0003', 'categorie' => 'Outillage', 'localisation' => 'Atelier', 'etat' => 'bon', 'marque' => 'Bosch', 'date_achat' => '2023-03-20', 'responsable' => 'Pierre Durand'],
            ['nom' => 'Véhicule Renault Kangoo', 'numero_serie' => 'VH-2024-0001', 'categorie' => 'Véhicule', 'localisation' => 'Parking', 'etat' => 'bon', 'marque' => 'Renault', 'date_achat' => '2021-11-05', 'responsable' => 'Sophie Bernard'],
            ['nom' => 'Climatiseur Daikin', 'numero_serie' => 'SN-2024-0005', 'categorie' => 'Électronique', 'localisation' => 'Salle de réunion A', 'etat' => 'defectueux', 'marque' => 'Daikin', 'date_achat' => '2020-08-22', 'responsable' => 'Jean Dupont'],
            ['nom' => 'Serveur Dell PowerEdge', 'numero_serie' => 'SN-2024-0006', 'categorie' => 'Informatique', 'localisation' => 'Salle serveurs', 'etat' => 'bon', 'marque' => 'Dell', 'date_achat' => '2022-12-01', 'responsable' => 'Admin IT'],
            ['nom' => 'Table de travail Steelcase', 'numero_serie' => 'SN-2024-0007', 'categorie' => 'Mobilier', 'localisation' => 'Bureau 5', 'etat' => 'bon', 'marque' => 'Steelcase', 'date_achat' => '2021-04-15', 'responsable' => 'RH'],
            ['nom' => 'Groupe électrogène Honda', 'numero_serie' => 'SN-2024-0008', 'categorie' => 'Électronique', 'localisation' => 'Entrepôt', 'etat' => 'a_verifier', 'marque' => 'Honda', 'date_achat' => '2019-07-30', 'responsable' => 'Maintenance'],
        ];

        foreach ($materiels as $m) {
            Materiel::create($m);
        }

        // Create sample inspections
        $inspectionData = [
            [1, $user->id,  '2024-01-10', 'conforme',     'Tout fonctionne correctement.'],
            [2, $user->id,  '2024-01-12', 'non_conforme', 'Bourrage papier fréquent. Nettoyage requis.'],
            [3, $admin->id, '2024-01-15', 'conforme',     'Batterie et moteur en bon état.'],
            [4, $admin->id, '2024-01-20', 'conforme',     'Révision annuelle effectuée.'],
            [5, $user->id,  '2024-01-22', 'non_conforme', 'Fuite de gaz frigorigène détectée.'],
            [6, $admin->id, '2024-02-01', 'conforme',     'Performance nominale.'],
            [7, $user->id,  '2024-02-05', 'en_attente',   'Inspection planifiée.'],
            [1, $admin->id, '2024-02-10', 'conforme',     'Mise à jour logicielle effectuée.'],
        ];

        foreach ($inspectionData as [$matId, $userId, $date, $statut, $obs]) {
            Inspection::create([
                'materiel_id'     => $matId,
                'user_id'         => $userId,
                'date_inspection' => $date,
                'statut'          => $statut,
                'observations'    => $obs,
            ]);
        }
    }
}
