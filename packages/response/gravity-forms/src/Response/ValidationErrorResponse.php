<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Response;

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
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'is_valid' => false,
            'page_number' => 1,
            'source_page_number' => 1,
            'validation_messages' => array_reduce(
                array_map(
                    $this->mapToValidationMessage(...),
                    array_keys($this->inputErrors),
                    array_values($this->inputErrors),
                ),
                fn(array $carry, array $item): array => $carry + $item,
                [],
            ),
        ];
    }

    /**
     * @return array<string, string>
     */
    private function mapToValidationMessage(string $fieldName, string $validationError): array
    {
        $inputKey = str_replace('input_', '', $fieldName);
        $primaryInputKey = explode('_', $inputKey)[0];

        return [$primaryInputKey => $validationError];
    }
}
