<?php

namespace App\Console\Commands;

use App\Mail\ProdutosUploadMail;
use App\Model\Produtos;
use App\Model\ProdutosUpload;
use App\Model\Usuarios;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ImportProdutosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'squad:import-produtos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa os produtos CSV pendentes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->processaArquivos();
    }

    protected function processaArquivos()
    {
        $uploads = ProdutosUpload::where('processado', 0)->orderBy('id', 'asc')->get();
        if (!empty($uploads[0])) {
            foreach ($uploads AS $upload) {
                $log = null;

                if ($upload->processado == 0) {
                    $upload->processado = 1;
                    //$upload->save();

                    $path = Storage::disk()->path("uploads/csv");
                    $file = $path . "/" . $upload->file;
                    if (file_exists($file)) {
                        $data = explode("\n", file_get_contents($file));

                        if (is_array($data)) {
                            $linha = 0;
                            foreach ($data AS $row) {
                                $linha++;
                                $produto = explode(";", $row);

                                if (is_array($produto) && count($produto) > 1) {
                                    try {
                                        $key = ['nome', 'categoria', 'preco', 'imagem', 'descricao', 'ativo'];
                                        $produto = array_combine($key, $produto);

                                        $_produto = Produtos::saveByCSV($produto);
                                        if (!empty($_produto->id)) {
                                            $log['success'][] = $_produto->nome;
                                        } else {
                                            $log['failure'][] = $produto;
                                        }
                                    } catch (\Exception $e) {
                                        //colocar erros
                                    }
                                }
                            }

                            $upload->processado = 2;
                            //$upload->save();
                        }
                    }
                }

                $this->sendMails($upload, $log);
            }
        }
    }

    private function sendMails($upload, $log)
    {
        $user = (new \App\Model\Usuarios)->_get($upload->user);
        Mail::to($user)->send(new ProdutosUploadMail($upload, $log));


        exit("<pre> => " . print_r($log, true) . "</pre>");
        exit("<pre> => " . print_r("EMAIL", true) . "</pre>");
    }

}
