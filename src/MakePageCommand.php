<?php

namespace Pjmarshall1\LaravelCommands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakePageCommand extends GeneratorCommand
{
    protected $signature = 'make:page {name}';

    protected $description = 'Create a new vue page';

    protected $type = 'Page';

    protected function rootNamespace(): string
    {
        return 'js';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Pages';
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
        return $this->resolveStubPath('/stubs/vue.page.stub');
    }
}
