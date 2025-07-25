<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\FormSubmission;

use Exception;
use HeadlessWpForms\ServerlessMockedResponse\Field\Field;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionValidator;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

final class FormSubmissionValidatorTest extends TestCase
{
    public function testInputErrorsAreCollectedFromThrownExceptions(): void
    {
        $someField = $this->createMock(Field::class);
        $anotherField = $this->createMock(Field::class);

        $someField->method('name')->willReturn('some-field');
        $someField->method('validate')->willThrowException(
            new Exception('Some validation error.'),
        );

        $anotherField->method('name')->willReturn('another-field');
        $anotherField->method('validate')->willThrowException(
            new Exception('Another validation error.'),
        );

        $this->assertSame(
            [
                'another-field' => 'Another validation error.',
                'some-field' => 'Some validation error.',
            ],
            (new FormSubmissionValidator())->validate(
                new FormSubmission(
                    $anotherField,
                    $someField,
                ),
            ),
        );
    }

    public function testInputErrorsAreEmptyWhenWhenNoExceptionsAreThrown(): void
    {
        $this->assertSame(
            [],
            (new FormSubmissionValidator())->validate(
                new FormSubmission(
                    $this->createMock(Field::class),
                    $this->createMock(Field::class),
                ),
            ),
        );
    }
}
