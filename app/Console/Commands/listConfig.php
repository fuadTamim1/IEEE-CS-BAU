<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use League\CommonMark\Node\Inline\Newline;

class listConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all configs settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings_header = ["Idx", "Key", "Value"];
        $settings = Setting::all();
        // foreach ($settings as $key => $value) {
        $this->table($settings_header, $settings);
        // }
    }
}
