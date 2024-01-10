<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = $this->argument('name');
        $className = class_basename($name);
        $camelCaseClassName = lcfirst($className);

        $repositoryPath = app_path('Repositories/' . $className . 'Repository.php');

        if (File::exists($repositoryPath)) {
            $this->error('Repository already exists!');
            return;
        }

        File::makeDirectory(dirname($repositoryPath), 0755, true, true);
        File::put($repositoryPath, $this->generateRepositoryContent($className, $camelCaseClassName));

        $this->line('');

        // Mavi arka planlı "INFO" mesajı
        $relativePath = strstr($repositoryPath, 'app/');

        // Repository oluşturma bilgisi
        $this->line('</>  <bg=blue;fg=white> INFO </> Repository [' . $relativePath . '] created successfully. ');

        // Altta boşluk
        $this->line('');
    }

    protected function generateRepositoryContent($className, $camelCaseClassName)
    {
        $repositoryStub = file_get_contents(resource_path('stubs/repository.stub'));
        return str_replace(['{{ClassName}}', '{{camelCaseClassName}}'], [$className, $camelCaseClassName], $repositoryStub);
    }
}
