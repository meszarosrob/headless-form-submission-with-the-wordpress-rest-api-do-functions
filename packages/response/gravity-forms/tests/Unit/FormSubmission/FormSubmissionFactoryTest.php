<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\FormSubmission;

use HeadlessWpForms\GravityForms\Field\AnyEmailField;
use HeadlessWpForms\GravityForms\Field\BeforeSpaceAgeField;
use HeadlessWpForms\GravityForms\Field\FakeTermsField;
use HeadlessWpForms\GravityForms\Field\SomebodysNameField;
use HeadlessWpForms\GravityForms\FormSubmission\FormSubmissionFactory;
use HeadlessWpForms\GravityForms\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\NoopField;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;

final class FormSubmissionFactoryTest extends TestCase
{
    public function testCreatesDefaultFieldsWithEmptyInputs(): void
    {
        $formSubmission = (new FormSubmissionFactory())->createFromInputs([]);

        $this->assertEquals(
            new FormSubmission(
                new SomebodysNameField('input_1', ''),
                new AnyEmailField('input_2', ''),
                new BeforeSpaceAgeField('input_3', ''),
                new FakeTermsField('input_5_1', ''),
            ),
            $formSubmission,
        );
    }

    public function testCreatesSubmissionWithProvidedInputs(): void
    {
        $formSubmission = (new FormSubmissionFactory())->createFromInputs([
            'input_1' => 'John Doe',
            'input_2' => 'john@johndoe.com',
            'input_3' => '1957-10-04',
            'input_4' => 'Some value',
            'input_5_1' => '1',
        ]);

        $this->assertEquals(
            new FormSubmission(
                new SomebodysNameField('input_1', 'John Doe'),
                new AnyEmailField('input_2', 'john@johndoe.com'),
                new BeforeSpaceAgeField('input_3', '1957-10-04'),
                new FakeTermsField('input_5_1', '1'),
                new NoopField('input_4', 'Some value'),
            ),
            $formSubmission,
        );
    }
}
