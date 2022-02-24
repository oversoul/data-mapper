<?php

namespace Aecodes\Mapper\Tests\Fixtures;

use Aecodes\Mapper\IDataMap;

class SampleMapper implements IDataMap
{
    public function entity(): string
    {
        return SampleWithoutArguments::class;
    }

    public function setters(): array
    {
        return [];
    }

    public function types(): array
    {
        return [];
    }

    public function state($instance): array
    {
        return [];
    }
}
