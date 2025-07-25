<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;

readonly final class AnyEmailField extends BaseField
{
    public function validate(): void
    {
        if (trim((string) $this->value()) === '') {
            throw new InvalidField('The field is required.');
        }

        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidField('The e-mail address entered is invalid.');
        }
    }
}
