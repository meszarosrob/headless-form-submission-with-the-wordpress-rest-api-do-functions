<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7;

use HeadlessWpForms\ContactForm7\FormSubmission\FormSubmissionFactory;
use HeadlessWpForms\ContactForm7\Response\SuccessResponseFactory;
use HeadlessWpForms\ContactForm7\Response\ValidationErrorResponseFactory;
// phpcs:ignore Generic.Files.LineLength.TooLong
use HeadlessWpForms\ServerlessMockedResponse\DOFormSubmissionProcessorFacade as DOFormSubmissionProcessorFacadeInterface;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionProcessor;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionValidator;
use HeadlessWpForms\ServerlessMockedResponse\HttpArgs\HttpArgsFactory;
use HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData\MultiPartFormDataFactory;
use HeadlessWpForms\ServerlessMockedResponse\MultiPartFormData\MultiPartFormDataParser;
use HeadlessWpForms\ServerlessMockedResponse\Response\Response;

readonly final class DOFormSubmissionProcessorFacade implements DOFormSubmissionProcessorFacadeInterface
{
    public function process(array $eventInput): Response
    {
        $httpArgs = (new HttpArgsFactory())->createFromDOEventInput($eventInput);
        $multiPartFormData = (new MultiPartFormDataFactory())->createFromHttpArgs($httpArgs);
        $inputs = (new MultiPartFormDataParser())->parse($multiPartFormData);
        $formSubmission = (new FormSubmissionFactory())->createFromInputs($inputs);

        return (new FormSubmissionProcessor(
            new FormSubmissionValidator(),
            new SuccessResponseFactory(),
            new ValidationErrorResponseFactory(),
        ))->process($formSubmission);
    }
}
