<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;

readonly final class FakeTermsField extends BaseField
{
    public function validate(): void
    {
        if (!filter_var($this->value(), FILTER_VALIDATE_BOOL)) {
            throw new InvalidField('This field is required.');
        }
    }
}
