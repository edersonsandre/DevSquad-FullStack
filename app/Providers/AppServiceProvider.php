<?php

namespace App\Providers;

use App\Events\CategoriasEvent;
use App\Events\ProdutosEvent;
use App\Events\UsuariosEvent;
use App\Model\Categorias;
use App\Model\Produtos;
use App\Model\Usuarios;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('components.form.input', 'input');

        Categorias::observe(CategoriasEvent::class);
        Produtos::observe(ProdutosEvent::class);
        Usuarios::observe(UsuariosEvent::class);
    }
}
