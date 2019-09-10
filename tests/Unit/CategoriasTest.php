<?php

namespace Tests\Unit;

use App\Model\Categorias;
use App\Model\Produtos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use PDO;
use Tests\TestCase;


class CategoriasTest extends TestCase
{
    protected function getConnection($connection = null)
    {
        $pdo = new PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    public function testSave()
    {
        $data = factory(Categorias::class, 1)->make()->toArray();

        foreach ($data AS $row) {
            $_categoria = (new \App\Model\Categorias())->_save($row);
            $this->assertIsObject($_categoria);

            $delete = $_categoria->delete();
            $this->assertTrue($delete);
        }
    }

    public function testUpdateAndCache()
    {
        $data = factory(Categorias::class, 1)->make();

        foreach ($data AS $categoria) {
            $categoria = (new \App\Model\Categorias())->_save($categoria->toArray());
            $this->assertIsObject($categoria);

            $key = uniqid();

            $categoria->ativo = 0;
            $categoria->nome = "Teste - {$key} - Categoria";

            // testando o cache
            (new \App\Model\Categorias())->_get($categoria->id);
            $_categoria = (new \App\Model\Categorias())->_get($categoria->id);

            $this->assertEquals(1, $_categoria->ativo);
            $categoria->save();

            $this->assertEquals(0, $categoria->ativo);
            $this->assertStringContainsString($key, $categoria->nome);

            $delete = $_categoria->delete();
            $this->assertTrue($delete);
        }
    }

    public function testLists()
    {
        $data = factory(Categorias::class, 5)->create();

        $lista = (new \App\Model\Categorias)->_lists();

        $this->assertIsArray($lista);

        $lista = (new \App\Model\Categorias)->_lists();
        foreach ($data AS $categoria) {
            $delete = $categoria->delete();
            $this->assertTrue($delete);
        }

    }

    public function testException()
    {
        try {
            $this->expectException((new \App\Model\Categorias())->_save([]));
        } catch (\Exception $e) {
            $this->assertEquals(0, $e->getCode());
        }
    }

    public function testGetListColumns(){
        $model = new Categorias();

        $this->assertEquals('nome', $model->_getListsColumns());
    }
}
