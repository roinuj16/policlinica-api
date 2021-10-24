<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Psy\Exception\RuntimeException;
use RecursiveIteratorIterator;

class MainController extends Controller
{

    /**
     * Metodo que faz upload e redimensiona imagens
     * @param $image
     * @param $folder
     * @param $size
     * @return string
     */
    protected function uploadFile($image, $folder, $width = 200, $height = 200, $unique = false, $thumb = false)
    {
        $retorno = [];
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->extension();
            $fileName = time() . random_int(100, 999) .'.' . $extension;
            $destinationPath = public_path('storage/'.$folder.'/');
            $destinationPathThumb = public_path('storage/'.$folder.'/thumb/');
            $url = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$folder.'/'.$fileName;

            $fullPath = $destinationPath.$fileName;

            if ($unique && file_exists($destinationPath)) {
                $this->cleanDir($destinationPath);
            } else if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $image = Image::make($file);
            if ($extension === '.pdf') {
                $image->save($fullPath);
            }


            $image->resize($width, $height);
            $image ->encode('jpg');
            $image->save($fullPath, 100);

            //Verifica se precisa criar Thumbnail
            if($thumb) {
                $fullPathThumb = $destinationPathThumb.$fileName;
                $url_thumb = 'http://'.$_SERVER['HTTP_HOST'].'/storage/'.$folder.'/thumb/'.$fileName;
                if (!file_exists($destinationPathThumb)) {
                    File::makeDirectory($destinationPathThumb, 0775);
                }

                $imageThumb = Image::make($file);
                $imageThumb->resize(150, 150);
                $imageThumb ->encode('jpg');
                $imageThumb->save($fullPathThumb, 100);

                $retorno['urlThumb'] = $url_thumb;

            }

            $retorno['url'] = $url;

        } else {
           return false;
        }

        return $retorno;
    }

    /**
     * Limpa um diretório
     * @param $camArquivo
     */
    private function cleanDir($camArquivo) {
        $di = new \RecursiveDirectoryIterator($camArquivo, \FilesystemIterator::SKIP_DOTS);
        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach ( $ri as $file ) {
            var_dump($file->isDir() ?  rmdir($file) : unlink($file));
        }

    }

    /**
     * O caminho do arquivo e gerado de acordo com a necessidade. Caso tenha que mandar o link para o email e necessário
     * enviar o parametro $downloadEmail como TRUE, se fo mandar o ARQUIVO para o email então o parametro $downloadEmail deve ser FALSE.
     * @param $file
     * @param $folder
     * @param $dirBook
     * @param bool $downloadEmail - True vai enviar link para baixar do email - false vai enviar o arquivo no email.
     * @return int|mixed|string
     */
    protected function uploadPdf($file, $folder, $dirBook, $downloadEmail = false)
    {
        $extension = $file->extension();
        $extension_valid = [
            'pdf'
        ];

        try {
            if (!in_array($extension, $extension_valid)) {
                throw new RuntimeException('Formato do arquivo e inválido.');
            }

            $storagePath = storage_path() . '/' . $folder . '/' .$dirBook;
            $fileName = time() . random_int(100, 999) . '.' . $extension;
            $pathname = $storagePath . '/' . $fileName;

            if(file_exists($storagePath)) {
                $this->cleanDir($storagePath);
            }

            $file->move($storagePath, $fileName);

            // Se for baixar do email precisa de tratamento no link.
            if ($downloadEmail === true) {
                $url_file = 'http://' . $_SERVER['HTTP_HOST'] . '/api/download/' . str_replace('/', '-', ltrim($pathname, '/'));
                return $url_file;
            }

            return $pathname;

        } catch (RuntimeException $e) {
            return $e->getCode();
        }
    }

}
