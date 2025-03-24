<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class add_config extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_config {--key=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->option('key');
        $value = $this->option('value');
        // Validate key presence
        if (!$key) {
            $this->error('The --key option is required.');
            return;
        }
        
        try {
            Setting::create([
                'key' => $key,
                'value' => $value,
            ]);
            $this->info("Config '{$key}' created successfully.");
        } catch (\Exception $e) {
            $this->error('Failed to create config: ' . $e->getMessage());
        }
    }
}
