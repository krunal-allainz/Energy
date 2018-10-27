<?php

namespace Energy\Console\Commands;

use Illuminate\Console\Command;

class GasProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gas:production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for production of gas on daily basis';

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
        //
    }
}
