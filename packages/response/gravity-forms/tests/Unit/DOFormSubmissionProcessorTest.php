<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit;

use HeadlessWpForms\GravityForms\DOFormSubmissionProcessorFacade;
use HeadlessWpForms\GravityForms\Tests\TestCase;

final class DOFormSubmissionProcessorTest extends TestCase
{
    public function testValidationErrorResponseIsReturnedWhenSubmissionIsEmpty(): void
    {
        $boundary = '----WebKitFormBoundaryLJN9iSLniPsxgAMe';
        $formData = $this->normalizeRawFormData(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="input_1"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="input_2"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="input_3"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="input_4"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="input_5_1"
                
                
                --{$boundary}--
                BODY,
        );

        $this->assertEquals(
            [
                'is_valid' => false,
                'page_number' => 1,
                'source_page_number' => 1,
                'validation_messages' => [
                    '1' => 'This field is required.',
                    '2' => 'This field is required.',
                    '3' => 'This field is required.',
                    '5' => 'This field is required.',
                ],
            ],
            (new DOFormSubmissionProcessorFacade())->process([
                'http' => [
                    'body' => $formData,
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=' . $boundary,
                    ],
                ],
            ])->data(),
        );
    }

    public function testValidationErrorResponseIsReturnedForPartiallyCompletedSubmission(): void
    {
        $boundary = '----WebKitFormBoundaryLJN9iSLniPsxgAMe';
        $formData = $this->normalizeRawFormData(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="input_1"
                
                John Doe
                --{$boundary}
                Content-Disposition: form-data; name="input_2"
                
                not-a-valid-email
                --{$boundary}
                Content-Disposition: form-data; name="input_3"
                
                2025-12-26
                --{$boundary}
                Content-Disposition: form-data; name="input_4"
                
                Anything else
                --{$boundary}
                Content-Disposition: form-data; name="input_5_1"
                
                1
                --{$boundary}--
                BODY,
        );

        $this->assertEquals(
            [
                'is_valid' => false,
                'page_number' => 1,
                'source_page_number' => 1,
                'validation_messages' => [
                    '2' => 'The email address entered is invalid, please check the formatting (e.g email@domain.com).',
                    '3' => 'The date entered is after the latest one allowed.',
                ],
            ],
            (new DOFormSubmissionProcessorFacade())->process([
                'http' => [
                    'body' => $formData,
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=' . $boundary,
                    ],
                ],
            ])->data(),
        );
    }

    public function testSuccessResponseIsReturnedOnCorrectSubmission(): void
    {
        $boundary = '----WebKitFormBoundaryLJN9iSLniPsxgAMe';
        $body = $this->normalizeRawFormData(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="input_1"
                
                John Doe
                --{$boundary}
                Content-Disposition: form-data; name="input_2"
                
                john@johndoe.com
                --{$boundary}
                Content-Disposition: form-data; name="input_3"
                
                1956-06-12
                --{$boundary}
                Content-Disposition: form-data; name="input_4"
                
                Anything else
                --{$boundary}
                Content-Disposition: form-data; name="input_5_1"
                
                1
                --{$boundary}--
                BODY,
        );

        $this->assertEquals(
            [
                // phpcs:ignore Generic.Files.LineLength.TooLong
                'confirmation_message' => '<div id="gform_confirmation_message_1" class="gform_confirmation_message_1 gform_confirmation_message">Thanks for contacting us! We will get in touch with you shortly.</div></div>',
                'confirmation_type' => 'message',
                'is_valid' => true,
                'page_number' => 0,
                'source_page_number' => 1,
            ],
            (new DOFormSubmissionProcessorFacade())->process([
                'http' => [
                    'body' => $body,
                    'headers' => [
                        'content-type' => 'multipart/form-data; boundary=' . $boundary,
                    ],
                ],
            ])->data(),
        );
    }
}
