<?php

namespace Tests\Unit;

use App\Helpers\DataHelpers;
use App\Helpers\UploadHelper;
use App\Model\Categorias;
use App\Model\Produtos;
use App\Model\Usuarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PDO;
use Tests\TestCase;


class UploadTest extends TestCase
{

    public function testgetImagemProduto()
    {
        $produto = factory(Produtos::class)->create();
        $this->assertNotEmpty($produto->imagem);

        $imagem = UploadHelper::getImagemProduto($produto->imagem);
        $this->assertNotNull($imagem);
    }

}
