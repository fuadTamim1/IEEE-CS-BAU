<?php

namespace App\Console\Commands;

use App\Models\TextWidget;
use Illuminate\Console\Command;

class add_text_widget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atw {--key=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Text Widget To Store Text With Key.';

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
            TextWidget::create([
                'key' => $key,
                'value' => $value,
            ]);
            $this->info("Text widget '{$key}' created successfully.");
        } catch (\Exception $e) {
            $this->error('Failed to create text widget: ' . $e->getMessage());
        }
    }
}
