<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PartidesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'usuari_id'    => 1,
                'data_partida' => date('Y-m-d H:i:s'),
                'resultat'     => 1,
                'puntuacio'    => 1500,
                'durada'       => 30,
                'dificultat'   => 3,
            ],
            [
                'usuari_id'    => 2,
                'data_partida' => date('Y-m-d H:i:s'),
                'resultat'     => 0,
                'puntuacio'    => 1200,
                'durada'       => 25,
                'dificultat'   => 2,
            ],
            [
                'usuari_id'    => 3,
                'data_partida' => date('Y-m-d H:i:s'),
                'resultat'     => 1,
                'puntuacio'    => 1700,
                'durada'       => 35,
                'dificultat'   => 4,
            ],
        ];

        $this->db->table('partides')->insertBatch($data);
    }
}
