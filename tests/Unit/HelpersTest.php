<?php

namespace Tests\Unit;

use App\Helpers\DataHelpers;
use App\Helpers\UtilHelpers;
use Tests\TestCase;


class HelpersTest extends TestCase
{

    public function testAtivo()
    {
        $data = DataHelpers::Ativo();

        $this->assertIsArray($data);
    }

    public function testClearFields()
    {
        $data = UtilHelpers::clearFields("10.00", "money");
        $this->assertNotEmpty($data);

        $data = UtilHelpers::clearFields(null, "produto-imagem");
        $this->assertNull($data);

        $data = UtilHelpers::clearFields(12, "id");
        $this->assertNotEmpty($data);
        $this->assertEquals(12, $data);

    }

}
