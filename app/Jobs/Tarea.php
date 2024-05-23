<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Tarea implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $parametro;

    /**
     * Create a new job instance.
     */
    public function __construct($parametro)
    {
        $this->parametro = $parametro;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Programar tarea relacionada con $parametro
    }
}
