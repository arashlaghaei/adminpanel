<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrateCoreSubfoldersCommand extends Command
{
    protected $name = 'core:migrate-custom';
    protected $description = 'Run migrations for the Core module, ensuring subfolders are included.';

    public function handle()
    {
        $moduleName = 'Core';
        $migrationBasePath = module_path($moduleName, 'Database/Migrations');

        if (!is_dir($migrationBasePath)) {
            $this->error("Migration path not found for module: {$moduleName} at {$migrationBasePath}");
            return 1;
        }

        $this->info("Scanning migrations recursively in: {$migrationBasePath}");

        $migrationFiles = collect(glob("{$migrationBasePath}/**/*.php"))->sortBy(fn($path) => basename($path));

        if ($migrationFiles->isEmpty()) {
            $this->warn("No migration files found.");
            return 0;
        }

        foreach ($migrationFiles as $file) {
            $this->line("Migrating file: {$file}");

            $exitCode = Artisan::call('migrate', [
                '--path' => $file,
                '--realpath' => true,
                '--database' => $this->option('database'),
                '--force' => $this->option('force'),
                '--step' => $this->option('step'),
            ]);

            $this->line(Artisan::output());

            if ($exitCode != 0) {
                $this->error("Migration failed for file: {$file}");
                return $exitCode;
            }
        }

        $this->info("✅ All migrations in Core module (including subfolders) completed successfully.");
        return 0;
    }

    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
            ['step', null, InputOption::VALUE_NONE, 'Force the migrations to be run so they can be rolled back individually.'],
        ];
    }
}