<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PopulateTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:populate {count=100000}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Populate the database with translations for testing scalability.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $count = (int) $this->argument('count');
        $this->info("Populating database with {$count} translations...");
    
        $batchSize = 1000; // Insert in batches of 1000
        $iterations = ceil($count / $batchSize);
    
        for ($i = 0; $i < $iterations; $i++) {
            Translation::factory()->count($batchSize)->create();
            $this->info("Inserted " . ($i + 1) * $batchSize . " records...");
        }
    
        $this->info("{$count} translations have been created successfully.");
    }
}