<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GeneratePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:permission {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate permission based table name, use comma as separator. Example generate:permission --table=users, roles';

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
        $tables = explode(',',$this->option('table'));
        foreach($tables as $table){
            $this->generatePermission(Str::snake(trim($table)));
        }        
    }

    private function generatePermission(string $permissionName)
    {
        \App\Models\Base\Permission::firstOrCreate(['name' => $permissionName.'-index', 'guard_name' => 'web']);
        \App\Models\Base\Permission::firstOrCreate(['name' => $permissionName.'-create', 'guard_name' => 'web']);
        \App\Models\Base\Permission::firstOrCreate(['name' => $permissionName.'-update', 'guard_name' => 'web']);
        \App\Models\Base\Permission::firstOrCreate(['name' => $permissionName.'-delete', 'guard_name' => 'web']);
    }
}
