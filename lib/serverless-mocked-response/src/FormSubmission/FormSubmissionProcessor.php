<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\FormSubmission;

use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmission;
use HeadlessWpForms\ServerlessMockedResponse\FormSubmission\FormSubmissionValidator;
use HeadlessWpForms\ServerlessMockedResponse\Response\Response;
use HeadlessWpForms\ServerlessMockedResponse\Response\SuccessResponseFactory;
use HeadlessWpForms\ServerlessMockedResponse\Response\ValidationErrorResponseFactory;

readonly final class FormSubmissionProcessor
{
    public function __construct(
        private FormSubmissionValidator $formSubmissionValidator,
        private SuccessResponseFactory $successResponseFactory,
        private ValidationErrorResponseFactory $validationErrorResponseFactory,
    ) {
    }

    public function process(FormSubmission $formSubmission): Response
    {
        $inputErrors = $this->formSubmissionValidator->validate($formSubmission);

        if ($inputErrors === []) {
            return $this->successResponseFactory->create();
        }

        return $this->validationErrorResponseFactory->create($inputErrors);
    }
}
