<?php

namespace Aecodes\Mapper;

interface IDataMap
{
    public function types(): array;

    public function entity(): string;

    public function setters(): array;

    public function state($instance): array;
}
