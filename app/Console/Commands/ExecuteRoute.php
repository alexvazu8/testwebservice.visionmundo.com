<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class ExecuteRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecutar la ruta para vaciar el registro del carrito cada 10 minutos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::delete(url('auth.vaciarRegistroCarrito'));
        
        if ($response->successful()) {
            $this->info('La ruta se ejecutó con éxito.');
        } else {
            $this->error('Hubo un problema al ejecutar la ruta.');
        }
    }
}
