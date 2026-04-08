<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('make:module {name}')]
#[Description('Generate a complete module (Model, Controller, Migration, View, Route)')]
class MakeModule extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name'); // "Post"

        // 1. Model + Migration
        $this->call('make:model', ['name' => $name, '--migration' => true]);

        // 2. Controller
        $this->generateController($name);

        // 3. Vues Blade
        $this->generateViews($name);

        // 4. Route
        $this->appendRoute($name);

        $this->components->info("Module [{$name}] generated successfully.");
    }

    private function generateController(string $name): void
    {
        $lower = strtolower($name);
        $plural = Str::plural($lower);

        $path = app_path("Http/Controllers/Backend");

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $stub = file_get_contents(base_path("stubs/controller.stub"));

        $stub = str_replace(
            ['{{ module }}', '{{ Module }}', '{{ modules }}'],
            [$lower, $name, $plural],
            $stub
        );

        file_put_contents("{$path}/{$name}Controller.php", $stub);
        $this->components->task("Creating controller [app/Http/Controllers/Backend/{$name}Controller.php]");
    }

    private function generateViews(string $name): void
    {
        $lower = strtolower($name);       // post
        $plural = Str::plural($lower);    // posts

        $views = ['index', 'create', 'edit', 'show'];
        $path = resource_path("views/backend/{$plural}");

        // Créer le dossier
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        foreach ($views as $view) {
            $stub = file_get_contents(base_path("stubs/views/{$view}.stub"));

            // Remplacer les placeholders
            $stub = str_replace(
                ['{{ module }}', '{{ Module }}', '{{ modules }}'],
                [$lower, $name, $plural],
                $stub
            );

            file_put_contents("{$path}/{$view}.blade.php", $stub);
            $this->components->task("Creating view [backend/{$plural}/{$view}.blade.php]");
        }
    }

    private function appendRoute(string $name): void
    {
        $lower = strtolower($name);
        $plural = Str::plural($lower);

        $route = "\nRoute::resource('{$plural}', \\App\\Http\\Controllers\\Backend\\{$name}Controller::class);";

        file_put_contents(base_path('routes/backend/index.php'), $route, FILE_APPEND);
        $this->components->task("Appending resource route to [routes/backend/index.php]");
    }
}
