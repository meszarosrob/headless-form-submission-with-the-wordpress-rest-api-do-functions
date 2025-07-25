<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Field;

use HeadlessWpForms\ServerlessMockedResponse\Field\BaseField;
use HeadlessWpForms\ServerlessMockedResponse\Field\InvalidField;

readonly final class BeforeSpaceAgeField extends BaseField
{
    public function validate(): void
    {
        if (trim((string) $this->value()) === '') {
            throw new InvalidField('This field is required.');
        }

        if (strtotime((string) $this->value()) === false) {
            throw new InvalidField('The date entered is invalid.');
        }

        if (strtotime((string) $this->value()) > strtotime('1957-10-04')) {
            throw new InvalidField('The date entered is after the latest one allowed.');
        }
    }
}
