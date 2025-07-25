<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit;

use HeadlessWpForms\ContactForm7\DOFormSubmissionProcessorFacade;
use HeadlessWpForms\ContactForm7\Tests\TestCase;

final class DOFormSubmissionProcessorTest extends TestCase
{
    public function testValidationErrorResponseIsReturnedWhenSubmissionIsEmpty(): void
    {
        $boundary = '----WebKitFormBoundaryGMtXXDKbyUhmr8gJ';
        $body = $this->normalizeMultipartFormDataBody(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="somebodys-name"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="any-email"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="before-space-age"
                
                
                --{$boundary}
                Content-Disposition: form-data; name="optional-message"
                
                
                --{$boundary}--
                BODY,
        );

        $this->assertEquals(
            [
                'into' => '#',
                'invalid_fields' => [
                    [
                        'error_id' => '-ve-any-email',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.any-email',
                        'message' => 'The field is required.',
                    ],
                    [
                        'error_id' => '-ve-before-space-age',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.before-space-age',
                        'message' => 'The field is required.',
                    ],
                    [
                        'error_id' => '-ve-fake-terms',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.fake-terms',
                        'message' => 'You must accept the terms and conditions before sending your message.',
                    ],
                    [
                        'error_id' => '-ve-somebodys-name',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.somebodys-name',
                        'message' => 'The field is required.',
                    ],
                ],
                'message' => 'One or more fields have an error. Please check and try again.',
                'posted_data_hash' => '',
                'status' => 'validation_failed',
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

    public function testValidationErrorResponseIsReturnedForPartiallyCompletedSubmission(): void
    {
        $boundary = '----WebKitFormBoundary3WcAajJx4c7LlpbZ';
        $body = $this->normalizeMultipartFormDataBody(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="somebodys-name"
                
                John Doe
                --{$boundary}
                Content-Disposition: form-data; name="any-email"
                
                not-a-valid-email
                --{$boundary}
                Content-Disposition: form-data; name="before-space-age"
                
                2025-12-26
                --{$boundary}
                Content-Disposition: form-data; name="optional-message"
                
                Anything else
                --{$boundary}
                Content-Disposition: form-data; name="fake-terms"
                
                1
                --{$boundary}--
                BODY,
        );

        $this->assertEquals(
            [
                'into' => '#',
                'invalid_fields' => [
                    [
                        'error_id' => '-ve-any-email',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.any-email',
                        'message' => 'The e-mail address entered is invalid.',
                    ],
                    [
                        'error_id' => '-ve-before-space-age',
                        'idref' => null,
                        'into' => 'span.wpcf7-form-control-wrap.before-space-age',
                        'message' => 'The date is after the latest one allowed.',
                    ],
                ],
                'message' => 'One or more fields have an error. Please check and try again.',
                'posted_data_hash' => '',
                'status' => 'validation_failed',
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

    public function testSuccessResponseIsReturnedOnCorrectSubmission(): void
    {
        $boundary = '----WebKitFormBoundarycuUVzZAhGZzEEnUB';
        $formData = $this->normalizeMultipartFormDataBody(
            <<<BODY
                --{$boundary}
                Content-Disposition: form-data; name="somebodys-name"
                
                John Doe
                --{$boundary}
                Content-Disposition: form-data; name="any-email"
                
                john@johndoe.com
                --{$boundary}
                Content-Disposition: form-data; name="before-space-age"
                
                1956-06-12
                --{$boundary}
                Content-Disposition: form-data; name="optional-message"
                
                Anything else
                --{$boundary}
                Content-Disposition: form-data; name="fake-terms"
                
                1
                --{$boundary}--
                BODY,
        );

        $this->assertSame(
            [
                'into' => '#',
                'message' => 'Thank you for your message. It has been sent.',
                'posted_data_hash' => 'd52f9f9de995287195409fe6dcde0c50',
                'status' => 'mail_sent',
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
}
