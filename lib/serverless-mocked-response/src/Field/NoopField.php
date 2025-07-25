<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Field;

readonly final class NoopField extends BaseField
{
    public function validate(): void
    {
        // No validation needed for NoopField.
    }
}
