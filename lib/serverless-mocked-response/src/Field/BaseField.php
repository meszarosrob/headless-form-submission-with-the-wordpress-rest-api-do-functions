<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Field;

readonly abstract class BaseField implements Field
{
    abstract public function validate(): void;

    public function __construct(
        private string $name,
        private mixed $value,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
