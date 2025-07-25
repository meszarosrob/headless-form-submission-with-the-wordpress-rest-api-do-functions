<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse\FormSubmission;

interface FormSubmissionFactory
{
    /**
     * @param array<string, mixed> $inputs
     */
    public function createFromInputs(array $inputs): FormSubmission;
}
