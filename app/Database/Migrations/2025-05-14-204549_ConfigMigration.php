<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConfigMigration extends Migration
{
    public function up()
    {
        //id user, tema, dificultat i musica
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'     => [
                'type'       => 'INT',
            ],
            'tema'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'dificultat'  => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'musica'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('config');
    }

    public function down()
    {
        $this->forge->dropTable('config');
    }
}
