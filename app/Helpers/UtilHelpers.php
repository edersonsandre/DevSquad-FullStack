<?php


namespace App\Helpers;


class UtilHelpers
{
    public static function clearFields($data, $tipo = null, $size = null)
    {
        $string = is_array($data) || is_object($data) ? null : $data;

        if ($tipo) {
            $string = self::getTipo($string, $tipo, $size);
        }
        return $string;

    }

    private static function getTipo($string, $tipo, $size = null)
    {
        switch ($tipo) {
            case "id" :
                $string = $string;
                break;
            case "produto-imagem" :
                $imagem = UploadHelper::getImagemProduto($string);
                $string = !empty($imagem) ? "<img src='{$imagem}' width='50px' class='img-thumbnail' >" : null;
                break;
            case "money" :
                $string = "<span class='pull-left'>R$</span> <span class='pull-right'>" . self::moneyMask($string) . "</span>";
                break;
        }

        return $string;
    }

    public static function moneyMask($valor = null)
    {
        return ($valor) ? number_format($valor, 2, ',', '.') : "0.00";
    }

}
