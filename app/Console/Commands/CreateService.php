<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create service class';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $dtoFilePath = app_path('Services/' . $name);

        if(file_exists($dtoFilePath . '.php'))
        {
            $this->line("<fg=red;bg=black>The file is already exist!!.</>");
            return null;
        }

        $dtoFilePath = fopen($dtoFilePath . '.php', 'w');
        fwrite($dtoFilePath, $this->dataFile($name));
        fclose($dtoFilePath);

        $this->line('<fg=green;bg=black>You create successfully dto class!</>');
        return null;

    }

    public function dataFile(string  $name) : string
    {
        return "<?php

namespace App\Services;

class {$name} {

    //code

}";
    }

}
