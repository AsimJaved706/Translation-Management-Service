<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Translation;

class PopulateTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:populate {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the translations table with dummy data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = (int) $this->argument('count');
        $locales = ['en', 'fr', 'es'];
        $contexts = ['web', 'mobile', 'desktop'];

        for ($i = 0; $i < $count; $i++) {
            Translation::create([
                'locale' => $locales[array_rand($locales)],
                'key' => 'key_' . $i,
                'content' => 'Translation content ' . $i,
                'context' => $contexts[array_rand($contexts)],
            ]);
        }

        $this->info("Successfully populated $count translations.");
        return Command::SUCCESS;
    }
}
