<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\Tests\Unit\FormSubmission;

use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionProcessor;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionValidator;
use HeadlessWpForms\ServerlessMockedResponse\Response\SuccessResponseFactory;
use HeadlessWpForms\ServerlessMockedResponse\Response\ValidationErrorResponseFactory;
use HeadlessWpForms\ServerlessMockedResponse\Tests\TestCase;

final class FormSubmissionProcessorTest extends TestCase
{
    public function testSuccessResponseFactoryIsCalledWhenNoInvalidErrors(): void
    {
        $formSubmissionValidator = $this->createMock(FormSubmissionValidator::class);
        $successResponseFactory = $this->createMock(SuccessResponseFactory::class);
        $validationErrorResponseFactory = $this->createMock(ValidationErrorResponseFactory::class);

        $formSubmissionValidator->method('validate')->willReturn([]);
        $successResponseFactory->expects($this->once())->method('create');
        $validationErrorResponseFactory->expects($this->never())->method('create');

        (new FormSubmissionProcessor(
            $formSubmissionValidator,
            $successResponseFactory,
            $validationErrorResponseFactory,
        ))->process(new FormSubmission());
    }

    public function testValidationErrorResponseFactoryIsCalledWhenInvalidErorrs(): void
    {
        $formSubmissionValidator = $this->createMock(FormSubmissionValidator::class);
        $successResponseFactory = $this->createMock(SuccessResponseFactory::class);
        $validationErrorResponseFactory = $this->createMock(ValidationErrorResponseFactory::class);

        $formSubmissionValidator->method('validate')->willReturn([
            'some-field' => 'Some validation error.',
        ]);
        $successResponseFactory->expects($this->never())->method('create');
        $validationErrorResponseFactory->expects($this->once())->method('create');

        (new FormSubmissionProcessor(
            $formSubmissionValidator,
            $successResponseFactory,
            $validationErrorResponseFactory,
        ))->process(new FormSubmission());
    }
}
