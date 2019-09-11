<?php

namespace App\Helpers;


use App\Model\Produtos;

class UploadHelper
{
    public static function produto(Produtos $model = null)
    {
        $imagem = null;
        if (!empty($model->imagem)) {
            $path = "{$model->getTable()}/{$model->id}/";

            $path = self::RecursivePath(PATH_UPLOAD . $path);

            if (is_object($model->imagem)) {

                // @codeCoverageIgnoreStart
                $path = str_replace('./public/', '', $path);
                $file = $model->imagem;

                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                if ($file->move($path, $filename)) {
                    $imagem = $path . $filename;
                }
                // @codeCoverageIgnoreEnd
            } else if (strstr($model->imagem, 'http')) {
                $extension = current(array_reverse(explode(".", $model->imagem)));

                if (!empty($extension) && strlen($extension) < 5) {
                    $filename = time() . '-' . uniqid() . '.' . $extension;

                    if (file_put_contents($path . $filename, file_get_contents($model->imagem))) {
                        $imagem = str_replace('./public/', '', $path . $filename);
                    }
                }
            }
        }

        return $imagem;
    }

    public static function produtosCSV($file)
    {
        $filename = null;
        if (is_object($file)) {
            // @codeCoverageIgnoreStart
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $upload = $file->storeAs('uploads/csv', $filename);


//
//            if ($file->move($path, $filename)) {
//                $imagem = $path . $filename;
//            }
            // @codeCoverageIgnoreEnd
        }

        return $filename;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function RecursivePath($path, $mode = 0777)
    {
        $dirs = explode(DIRECTORY_SEPARATOR, $path);

        $path = '.';
        for ($i = 0; $i < count($dirs); ++$i) {
            $path .= DIRECTORY_SEPARATOR . $dirs[$i];
            if (!is_dir($path) && !mkdir($path, $mode, true)) {
                return false;
            }
        }

        return $path;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function RemoverPath($path)
    {
        if (file_exists($path)) {
            if ($dd = opendir($path)) {
                while (false !== ($Arq = readdir($dd))) {
                    if ($Arq != "." && $Arq != "..") {
                        $Path = "{$path}/$Arq";
                        if (is_dir($Path)) {
                            self::RemoverPath($Path);
                        } elseif (is_file($Path)) {
                            unlink($Path);
                        }
                    }
                }
                closedir($dd);
            }
            rmdir($path);
        }
    }

    public static function getImagemProduto($string = null)
    {
        $imagem = null;

        if (!is_null($string)) {
            $imagem = "/" . $string;
        }

        return $imagem;
    }

}
