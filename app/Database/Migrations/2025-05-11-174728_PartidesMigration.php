<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PartidesMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'usuari_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'data_partida' => [
                'type'           => 'DATETIME',
                'null'           => false,
            ],
            'resultat' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'null'           => false,
                'default'        => 0,
            ],
            'puntuacio' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'durada' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'dificultat' => [
                'type'           => 'TINYINT',
                'constraint'     => '1',
                'null'           => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null'
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('partides');
    }

    public function down()
    {
        $this->forge->dropTable('partides');
    }
}
