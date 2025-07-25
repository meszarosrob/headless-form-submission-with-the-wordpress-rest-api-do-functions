<?php

declare(strict_types=1);

namespace HeadlessWpForms\ContactForm7\Response;

use HeadlessWpForms\ServerlessMockedResponse\Response\Response;

final class SuccessResponse implements Response
{
    /**
     * @return array<string, string>
     */
    public function data(): array
    {
        return [
            'into' => '#',
            'message' => 'Thank you for your message. It has been sent.',
            'posted_data_hash' => 'd52f9f9de995287195409fe6dcde0c50',
            'status' => 'mail_sent',
        ];
    }
}
