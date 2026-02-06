<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\InventarioMail;

class ConsultaInventario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consulta:inventario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consultar productos con stock bajo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to([opcionSlug('email_notificacion') , 'info@ewebpanama.com' , 'joydisenos@gmail.com'])->send(new InventarioMail());
        echo 'mail enviado';
        return Command::SUCCESS;
    }
}
