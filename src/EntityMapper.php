<?php

namespace Aecodes\Mapper;

use ReflectionClass;

class EntityMapper
{
    protected IDataMap $map;

    public function __construct(string $map)
    {
        $this->map = new $map();
    }

    public function map(array $data)
    {
        $instance = $this->buildObjectInstance($data);
        $this->callInstanceSetters($instance, $data);

        return $instance;
    }

    public function buildObjectInstance(array $data)
    {
        $arguments = array_map(
            fn ($field) => $this->parseValue($data[$field] ?? '', $this->getFieldType($field)),
            $this->getConstructorFields()
        );

        return (new ReflectionClass($this->map->entity()))->newInstanceArgs($arguments);
    }

    public function parseValue(string $value, $type = null)
    {
        if (!$type) {
            return $value;
        }

        if (is_array($type)) {
            return call_user_func_array($type, [$value]);
        }

        if (is_callable($type)) {
            return call_user_func($type, [$value]);
        }

        return (new ReflectionClass($type))->newInstance($value);
    }

    public function getConstructorFields()
    {
        return array_keys(array_filter(
            $this->map->setters(),
            fn ($value) => ('' === $value),
        ));
    }

    public function data($instance): array
    {
        return $this->map->state($instance);
    }

    protected function getFieldType($field)
    {
        return $this->map->types()[$field] ?? null;
    }

    protected function callInstanceSetters($instance, array $data)
    {
        foreach ($this->getFieldsSetters() as $field => $setter) {
            $value = $this->parseValue($data[$field] ?? '', $this->getFieldType($field));
            call_user_func([$instance, $setter], $value);
        }
    }

    protected function getFieldsSetters()
    {
        return array_filter(
            $this->map->setters(),
            fn ($value) => ('' !== $value),
        );
    }
}
