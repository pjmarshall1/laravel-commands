<?php

namespace Pjmarshall1\LaravelCommands;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeComponentCommand extends GeneratorCommand
{
    protected $signature = 'make:component {name}';

    protected $description = 'Create a new vue component';

    protected $type = 'Component';

    protected function rootNamespace(): string
    {
        return 'js';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Components';
    }
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return resource_path('js').str_replace('\\', '/', $name).'.vue';
    }
    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }
    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/vue.component.stub');
    }
}
