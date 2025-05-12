<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
            $data = [
            [
                'name'      => 'Joan Garcia',
                'email'     => 'joan@example.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'edad'      => 25,
                'telefono'  => '600112233',
                'pais'      => 'Espanya',
            ],
            [
                'name'      => 'Maria López',
                'email'     => 'maria@example.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'edad'      => 30,
                'telefono'  => '611223344',
                'pais'      => 'Andorra',
            ],
            [
                'name'      => 'Carlos Pérez',
                'email'     => 'carlos@example.com',
                'password'  => password_hash('1234', PASSWORD_DEFAULT),
                'edad'      => 22,
                'telefono'  => '622334455',
                'pais'      => 'Alemania',
            ]
        ];

        // Insertamos los datos
        $this->db->table('users')->insertBatch($data);
    
    }
}
