<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name} {--r|--repository}';

    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $createRepository = $this->option('repository');
        $className = class_basename($name);
        $camelCaseClassName = lcfirst($className);

        $servicePath = app_path('Services/' . str_replace('/', '/', $name) . 'Service.php');
        $repositoryPath = app_path('Repositories/' . $className . 'Repository.php');

        if (File::exists($servicePath)) {
            $this->error('Service already exists!');
            return;
        }
        if (File::exists($repositoryPath)) {
            $this->error('Repository already exists!');
            return;
        }

        File::makeDirectory(dirname($servicePath), 0755, true, true);
        File::put($servicePath, $this->generateServiceContent($className, $camelCaseClassName));

        if ($createRepository) {
            File::put($repositoryPath, $this->generateRepositoryContent($className, $camelCaseClassName));

            $this->line('');

            // Mavi arka planlı "INFO" mesajı
            $serviceRelativePath = strstr($servicePath, 'app/');

            // Service oluşturma bilgisi
            $this->line('</>  <bg=blue;fg=white> INFO </> Service [' . $serviceRelativePath . '] created successfully. ');

            // Altta boşluk
            $this->line('');

            $this->line('');

            // Mavi arka planlı "INFO" mesajı
            $repositoryRelativePath = strstr($repositoryPath, 'app/');

            // Repository oluşturma bilgisi
            $this->line('</>  <bg=blue;fg=white> INFO </> Repository [' . $repositoryRelativePath . '] created successfully. ');

            // Altta boşluk
            $this->line('');

        } else {
            $this->line('');

            // Mavi arka planlı "INFO" mesajı
            $relativePath = strstr($servicePath, 'app/');

            // Service oluşturma bilgisi
            $this->line('</>  <bg=blue;fg=white> INFO </> Service [' . $relativePath . '] created successfully. ');

            // Altta boşluk
            $this->line('');
        }
    }

    protected function generateServiceContent($className, $camelCaseClassName)
    {
        $serviceStub = file_get_contents(resource_path('stubs/service.stub'));
        return str_replace(['{{ClassName}}', '{{camelCaseClassName}}'], [$className, $camelCaseClassName], $serviceStub);
    }

    protected function generateRepositoryContent($className, $camelCaseClassName)
    {
        $repositoryStub = file_get_contents(resource_path('stubs/repository.stub'));
        return str_replace(['{{ClassName}}', '{{camelCaseClassName}}'], [$className, $camelCaseClassName], $repositoryStub);
    }
}
