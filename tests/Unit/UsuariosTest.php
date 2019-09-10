<?php

namespace Tests\Unit;

use App\Model\Categorias;
use App\Model\Produtos;
use App\Model\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PDO;
use Tests\TestCase;


class UsuariosTest extends TestCase
{
    protected function getConnection($connection = null)
    {
        $pdo = new PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    public function testSave()
    {
        $data = factory(Usuarios::class, 1)->make()->toArray();

        foreach ($data AS $row) {
            $usuario = (new \App\Model\Usuarios())->_save($row);
            $this->assertIsObject($usuario);

            $delete = $usuario->_delete($usuario->id);
            $this->assertTrue($delete);
        }
    }

}
