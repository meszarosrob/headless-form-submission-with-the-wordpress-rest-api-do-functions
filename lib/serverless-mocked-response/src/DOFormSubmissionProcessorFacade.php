<?php

declare(strict_types=1);

namespace HeadlessWpForms\ServerlessMockedResponse;

use HeadlessWpForms\ServerlessMockedResponse\Response\Response;

/**
 * @phpstan-import-type DOEventInput from Type
 */
interface DOFormSubmissionProcessorFacade
{
    /**
     * @param DOEventInput $eventInput
     * @see https://docs.digitalocean.com/products/functions/reference/runtimes/php/#event-parameter
     */
    public function process(array $eventInput): Response;
}
