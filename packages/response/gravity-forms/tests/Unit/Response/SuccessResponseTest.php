<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests\Unit\Response;

use HeadlessWpForms\GravityForms\Response\SuccessResponse;
use HeadlessWpForms\GravityForms\Tests\TestCase;

final class SuccessResponseTest extends TestCase
{
    public function testSuccessResponseMatchesPredefinedPayload(): void
    {
        $this->assertSame(
            [
                // phpcs:ignore Generic.Files.LineLength.TooLong
                'confirmation_message' => '<div id="gform_confirmation_message_1" class="gform_confirmation_message_1 gform_confirmation_message">Thanks for contacting us! We will get in touch with you shortly.</div></div>',
                'confirmation_type' => 'message',
                'is_valid' => true,
                'page_number' => 0,
                'source_page_number' => 1,
            ],
            (new SuccessResponse())->data(),
        );
    }
}
