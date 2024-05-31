<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('accion:firma-de-mi-comando', [
            'parametro1' => 'valor parametro1', 
            'parametro2' => 'valor parametro2'
        ])->daily();

        /*
            daily: Una vez al día
            dailyAt: Una vez al día en una hora determinada
            hourly: Cada hora
            cron: Requiere de una expresión cron
                + Ejemplo: '0 * * * *'  (minutos, horas, dias, meses, dias de la semana)
                + días de la semana: 1: lunes, 2: martes, 3: miercoles, 4: jueves, 5: viernes, 6: sabado, 7: domingo
                + * = todos los valores (todos los minutos, todos los horas, todos los dias, todos los meses, todos los dias de la semana)
        */
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
