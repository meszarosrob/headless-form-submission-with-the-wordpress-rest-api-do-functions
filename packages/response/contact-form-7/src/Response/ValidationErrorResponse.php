<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Response;

use HeadlessWpForms\ServerlessMockedResponse\Response\Response;

readonly final class ValidationErrorResponse implements Response
{
    /**
     * @param array<string, string> $inputErrors
     */
    public function __construct(
        private array $inputErrors,
    ) {
    }

    /**
     * @return array<string, string|array<array<string, string|null>>>
     */
    public function data(): array
    {
        return [
            'into' => '#',
            'invalid_fields' => array_map(
                $this->mapToInvalidField(...),
                array_keys($this->inputErrors),
                array_values($this->inputErrors),
            ),
            'message' => 'One or more fields have an error. Please check and try again.',
            'posted_data_hash' => '',
            'status' => 'validation_failed',
        ];
    }

    /**
     * @return array<string, string|null>
     */
    private function mapToInvalidField(string $fieldName, string $validationError): array
    {
        return [
            'error_id' => '-ve-' . $fieldName,
            'idref' => null,
            'into' => 'span.wpcf7-form-control-wrap.' . $fieldName,
            'message' => $validationError,
        ];
    }
}
