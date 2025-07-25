<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;

readonly final class AnyEmailField extends BaseField
{
    public function validate(): void
    {
        if (trim((string) $this->value()) === '') {
            throw new InvalidField('This field is required.');
        }

        if (!filter_var($this->value(), FILTER_VALIDATE_EMAIL)) {
            // phpcs:ignore Generic.Files.LineLength.TooLong
            throw new InvalidField('The email address entered is invalid, please check the formatting (e.g email@domain.com).');
        }
    }
}
