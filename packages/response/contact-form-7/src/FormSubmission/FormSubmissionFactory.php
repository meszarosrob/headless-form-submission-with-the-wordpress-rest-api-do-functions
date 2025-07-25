<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\FormSubmission;

use HeadlessWpForms\ContactForm7\Field\AnyEmailField;
use HeadlessWpForms\ContactForm7\Field\BeforeSpaceAgeField;
use HeadlessWpForms\ContactForm7\Field\FakeTermsField;
use HeadlessWpForms\ContactForm7\Field\SomebodysNameField;
use HeadlessWpForms\ServerlessMockedResponse\Field\Field;
use HeadlessWpForms\ServerlessMockedResponse\Field\NoopField;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionFactory as FormSubmissionFactoryInterface;

readonly final class FormSubmissionFactory implements FormSubmissionFactoryInterface
{
    private const DEFAULT_INPUTS = [
        'any-email',
        'before-space-age',
        'fake-terms',
        'somebodys-name',
    ];

    public function createFromInputs(array $inputs): FormSubmission
    {
        $data = [
            ...array_fill_keys(self::DEFAULT_INPUTS, ''),
            ...$inputs,
        ];

        return new FormSubmission(
            ...array_map(
                $this->mapToField(...),
                array_keys($data),
                array_values($data),
            ),
        );
    }

    private function mapToField(string $name, mixed $value): Field
    {
        return match ($name) {
            'any-email' => new AnyEmailField($name, $value),
            'before-space-age' => new BeforeSpaceAgeField($name, $value),
            'fake-terms' => new FakeTermsField($name, $value),
            'somebodys-name' => new SomebodysNameField($name, $value),
            default => new NoopField($name, $value),
        };
    }
}
