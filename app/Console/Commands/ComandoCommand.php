<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ComandoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accion:firma-de-mi-comando';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Breve descripción de mi comando';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Acciones de mi comando
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            //throw $th;
            return Command::FAILURE;
        }
    }
}
