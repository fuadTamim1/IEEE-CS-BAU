<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportRowDataMembers extends Command
{
    protected $signature = 'import:convert {src} {dest?}';
    protected $description = 'Turn a whitespace‑delimited export into a CSV for MemberImporter';

    public function handle()
    {
        $src     = $this->argument('src');
        $dest    = $this->argument('dest') ?? 'storage/app/converted-members.csv';
        $lines   = file($src, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $fp = fopen($dest, 'w');
        fputcsv($fp, ['name','title','major','class_of_the_year','contacts']);

        $lastMajor = null;
        $lastYear  = date('Y');

        foreach ($lines as $line) {
            // split on tabs or many spaces
            $cols = preg_split('/\s+/', trim($line));

            // there are more than enough columns; we only care about
            // 0:name, 3:email, 4:facebook, 5:phone, 6:major, 7:class
            $name  = $cols[0] ?? '';
            $email = $cols[3] ?? '';
            $fb    = $cols[4] ?? '';
            $phone = $cols[5] ?? '';
            $major = $cols[6] ?? $lastMajor;
            $year  = $cols[7] ?? $lastYear;

            $lastMajor = $major ?: $lastMajor;
            $lastYear  = is_numeric($year) ? $year : $lastYear;

            // build a very simple contacts JSON
            $contacts = [];
            if ($email) {
                $contacts[] = ['key' => 'email', 'value' => $email];
            }
            if (Str::startsWith($fb, 'http')) {
                $contacts[] = ['key' => 'facebook', 'value' => $fb];
            }
            if (preg_match('/\d{7,}/', $phone, $m)) {
                $contacts[] = ['key' => 'phone', 'value' => $m[0]];
            }

            fputcsv($fp, [
                $name,
                'Member',          // title fixed
                $major ?: 'Unknown',
                $year,
                json_encode($contacts),
            ]);
        }

        fclose($fp);

        $this->info("Converted {$src} → {$dest}");
    }
}