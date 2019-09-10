<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'name' => 'Éderson Sandre',
            'email' => 'ederson.sandre@gmail.com',
            'password' => 'sandre11',
        ];

        foreach ($data AS $row) {
            (new App\Model\Usuarios())->_save($row);
        }
    }
}
