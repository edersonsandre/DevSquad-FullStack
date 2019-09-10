<?php

namespace Tests\Unit;

use App\Model\Categorias;
use App\Model\Produtos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PDO;
use Tests\TestCase;


class ProdutosTest extends TestCase
{
    protected function getConnection($connection = null)
    {
        $pdo = new PDO('sqlite::memory:');
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    public function testSave()
    {
        $produtos = factory(Produtos::class, 1)->make()->toArray();

        foreach ($produtos AS $produto) {
            $_produto = (new \App\Model\Produtos)->_save($produto);
            $this->assertIsObject($_produto);

            $this->assertFileExists(public_path($_produto->imagem));

            $delete = $_produto->_delete($_produto->id);
            $this->assertTrue($delete);

            $this->assertFileNotExists(public_path($_produto->imagem));
        }
    }

    public function testUpdateAndCache()
    {
        $produtos = factory(Produtos::class, 1)->make();

        foreach ($produtos AS $produto) {
            $produto = (new \App\Model\Produtos)->_save($produto->toArray());
            $this->assertIsObject($produto);

            $key = uniqid();

            $produto->ativo = 0;
            $produto->nome = "Teste - {$key} - Produto";

            $_produto = (new \App\Model\Produtos)->_get($produto->id);

            $this->assertEquals(1, $_produto->ativo);
            $produto->save();

            $this->assertEquals(0, $produto->ativo);
            $this->assertStringContainsString($key, $produto->nome);

            $delete = $_produto->delete();
            $this->assertTrue($delete);
        }
    }

    public function testUpdateNoImage()
    {
        $produtos = factory(Produtos::class, 1)->make();

        foreach ($produtos AS $produto) {
            $produto = (new \App\Model\Produtos)->_save($produto->toArray());
            $this->assertIsObject($produto);

            $produto->ativo = 0;
            $produto->imagem = null;
            $this->assertTrue($produto->save());

            $delete = $produto->delete();
            $this->assertTrue($delete);
        }
    }

    public function testListagem(){
        $produto = factory(Produtos::class)->create();
        $this->assertIsObject($produto);

        $listagem = $produto->_listagem();
        $this->assertIsObject($listagem);

        $search = uniqid();
        $produto->nome = "{$search} - ".$produto->nome;
        $produto->save();

        $listagem = $produto->_listagem($search);
        $this->assertIsObject($listagem);

        $delete = $produto->delete();
        $this->assertTrue($delete);
    }

    public function testCategoria(){
        $produto = factory(Produtos::class)->create();
        $this->assertIsObject($produto);

        $this->assertIsObject($produto->categorias);

        $delete = $produto->delete();
        $this->assertTrue($delete);
    }

    public function testGetListColumns(){
        $model = new Produtos();

        $this->assertEquals('nome', $model->_getListsColumns());
    }

}
