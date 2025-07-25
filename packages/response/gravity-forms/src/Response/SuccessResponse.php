<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Response;

use HeadlessWpForms\ServerlessMockedResponse\Response\Response;

final class SuccessResponse implements Response
{
    /**
     * @return array<string, int|string|bool>
     */
    public function data(): array
    {
        return [
            // phpcs:ignore Generic.Files.LineLength.TooLong
            'confirmation_message' => '<div id="gform_confirmation_message_1" class="gform_confirmation_message_1 gform_confirmation_message">Thanks for contacting us! We will get in touch with you shortly.</div></div>',
            'confirmation_type' => 'message',
            'is_valid' => true,
            'page_number' => 0,
            'source_page_number' => 1,
        ];
    }
}
