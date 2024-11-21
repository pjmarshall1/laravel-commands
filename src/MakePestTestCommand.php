<?php

namespace Pjmarshall1\LaravelCommands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakePestTestCommand extends GeneratorCommand
{
    protected $signature = 'make:test {name} {--unit}';

    protected $description = 'Command description';

    protected function rootNamespace(): string
    {
        return 'Tests';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        if ($this->option('unit')) {
            return $rootNamespace.'\Unit';
        } else {
            return $rootNamespace.'\Feature';
        }
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('tests').str_replace('\\', '/', $name).'.php';
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getStub(): string
    {
        $suffix = $this->option('unit') ? '.unit.stub' : '.feature.stub';

        return $this->resolveStubPath('/stubs/pest'.$suffix);
    }
}
