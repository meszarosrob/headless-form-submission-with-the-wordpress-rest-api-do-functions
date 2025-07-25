<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\FormSubmission;

use HeadlessWpForms\ServerlessMockedResponse\Field\Field;

readonly final class FormSubmission
{
    /** @var array<Field> */
    public array $fields;

    public function __construct(Field ...$fields)
    {
        $this->fields = $fields;
    }
}
