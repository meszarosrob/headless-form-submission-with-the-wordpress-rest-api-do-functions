<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\FormSubmission;

use HeadlessWpForms\GravityForms\Field\AnyEmailField;
use HeadlessWpForms\GravityForms\Field\BeforeSpaceAgeField;
use HeadlessWpForms\GravityForms\Field\FakeTermsField;
use HeadlessWpForms\GravityForms\Field\SomebodysNameField;
use HeadlessWpForms\ServerlessMockedResponse\Field\Field;
use HeadlessWpForms\ServerlessMockedResponse\Field\NoopField;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionFactory as FormSubmissionFactoryInterface;

readonly final class FormSubmissionFactory implements FormSubmissionFactoryInterface
{
    private const DEFAULT_INPUTS = [
        'input_1',
        'input_2',
        'input_3',
        'input_5_1',
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
            'input_1' => new SomebodysNameField($name, $value),
            'input_2' => new AnyEmailField($name, $value),
            'input_3' => new BeforeSpaceAgeField($name, $value),
            'input_5_1' => new FakeTermsField($name, $value),
            default => new NoopField($name, $value),
        };
    }
}
