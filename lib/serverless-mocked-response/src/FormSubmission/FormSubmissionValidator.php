<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\FormSubmission;

use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use Throwable;

// phpcs:ignore SlevomatCodingStandard.Classes.RequireAbstractOrFinal
class FormSubmissionValidator
{
    /**
     * @return array<string, string>
     */
    public function validate(FormSubmission $formSubmission): array
    {
        $errors = [];

        foreach ($formSubmission->fields as $field) {
            try {
                $field->validate();
            } catch (Throwable $e) {
                $errors[$field->name()] = $e->getMessage();
            };
        }

        return $errors;
    }
}
