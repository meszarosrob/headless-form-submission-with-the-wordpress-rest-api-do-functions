<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\FormSubmission;

use HeadlessWpForms\ContactForm7\Field\AnyEmailField;
use HeadlessWpForms\ContactForm7\Field\BeforeSpaceAgeField;
use HeadlessWpForms\ContactForm7\Field\FakeTermsField;
use HeadlessWpForms\ContactForm7\Field\SomebodysNameField;
use HeadlessWpForms\ContactForm7\FormSubmission\FormSubmissionFactory;
use HeadlessWpForms\ContactForm7\Tests\TestCase;
use HeadlessWpForms\ServerlessMockedResponse\Field\NoopField;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;

final class FormSubmissionFactoryTest extends TestCase
{
    public function testFormSubmissionContainsRequiredFieldsWhenSubmissionIsEmpty(): void
    {
        $this->assertEquals(
            new FormSubmission(
                new AnyEmailField('any-email', ''),
                new BeforeSpaceAgeField('before-space-age', ''),
                new FakeTermsField('fake-terms', ''),
                new SomebodysNameField('somebodys-name', ''),
            ),
            (new FormSubmissionFactory())->createFromInputs([]),
        );
    }

    public function testFormSubmissionMatchesSubmissionContent(): void
    {
        $this->assertEquals(
            new FormSubmission(
                new AnyEmailField('any-email', 'john@johndoe.com'),
                new BeforeSpaceAgeField('before-space-age', '1957-10-04'),
                new FakeTermsField('fake-terms', '1'),
                new SomebodysNameField('somebodys-name', 'John Doe'),
                new NoopField('optional-message', 'Some value'),
            ),
            (new FormSubmissionFactory())->createFromInputs([
                'any-email' => 'john@johndoe.com',
                'before-space-age' => '1957-10-04',
                'fake-terms' => '1',
                'optional-message' => 'Some value',
                'somebodys-name' => 'John Doe',
            ]),
        );
    }
}
