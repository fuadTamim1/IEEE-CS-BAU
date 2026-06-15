<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Spatie\Permission\Models\Role;

$highlights = [
    "view_any_blog", "create_blog", "update_blog", "delete_blog",
    "view_any_user", "page_Dashboard", "page_BcpcMonitoring", "page_Settings",
    "widget_BlogPipelineOverview", "widget_ContestTeamSizeChart"
];

$roles = Role::with("permissions")->get();

printf("%-20s | %-5s | %s\n", "Role", "Total", "Highlights Found");
printf("%s\n", str_repeat("-", 80));

foreach ($roles as $role) {
    $rolePerms = $role->permissions->pluck("name")->toArray();
    $foundHighlights = array_intersect($highlights, $rolePerms);
    
    printf("%-20s | %-5d | %s\n", 
        $role->name, 
        count($rolePerms), 
        implode(", ", $foundHighlights)
    );
}
