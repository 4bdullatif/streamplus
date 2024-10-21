<?php

namespace App\Dto;

abstract class BaseDto
{
    public static function create(): self
    {
        return new static();
    }

    abstract public static function fromArray(array $data): self;

    abstract public function toArray(): array;
}
