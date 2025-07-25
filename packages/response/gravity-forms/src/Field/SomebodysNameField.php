<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;

readonly final class SomebodysNameField extends BaseField
{
    public function validate(): void
    {
        if (trim((string) $this->value()) === '') {
            throw new InvalidField('This field is required.');
        }
    }
}
