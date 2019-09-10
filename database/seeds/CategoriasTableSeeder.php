<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Calçados', 'Roupas', 'Acessórios', 'Esporte', 'Beleza'];

        foreach ($data AS $row) {
            (new App\Model\Categorias)->_save(['nome' => $row]);
        }
    }
}
