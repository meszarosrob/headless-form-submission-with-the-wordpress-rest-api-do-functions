<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Field;

interface Field
{
    public function name(): string;

    public function value(): mixed;

    /**
     * @throws InvalidField
     */
    public function validate(): void;
}
