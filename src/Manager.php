<?php

namespace Aecodes\Mapper;

final class Manager
{
    protected static $instance;
    protected EntityMapper $mapper;

    protected function __construct(string $mapper)
    {
        $this->mapper = new EntityMapper($mapper);
    }

    public static function for(string $mapper): self
    {
        if (!static::$instance) {
            static::$instance = new self($mapper);
        }

        return static::$instance;
    }

    public function one($data)
    {
        if (empty($data)) {
            return [];
        }

        return $this->mapper->map($data);
    }

    public function many(array $data): array
    {
        if (empty($data)) {
            return [];
        }

        return array_map(fn ($row) => $this->mapper->map($row), $data);
    }

    public function snapshot($object): array
    {
        return $this->mapper->data($object);
    }
}
