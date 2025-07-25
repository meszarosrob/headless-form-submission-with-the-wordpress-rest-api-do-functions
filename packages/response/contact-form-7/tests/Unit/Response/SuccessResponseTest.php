<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Tests\Unit\Response;

use HeadlessWpForms\ContactForm7\Response\SuccessResponse;
use HeadlessWpForms\ContactForm7\Tests\TestCase;

final class SuccessResponseTest extends TestCase
{
    public function testSuccessResponseMatchesPredefinedPayload(): void
    {
        $this->assertSame(
            [
                'into' => '#',
                'message' => 'Thank you for your message. It has been sent.',
                'posted_data_hash' => 'd52f9f9de995287195409fe6dcde0c50',
                'status' => 'mail_sent',
            ],
            (new SuccessResponse())->data(),
        );
    }
}
