<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Boleto;
use App\Jobs\SendEmailJob;

class SendBoletosEmails extends Command
{
    protected $signature = 'send:boletos-emails';
    protected $description = 'Send emails to all boletos';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $boletos = Boleto::all();

        foreach ($boletos as $boleto) {
            SendEmailJob::dispatch($boleto->email);
        }

        $this->info('Emails despachados para a fila.');
    }
}
