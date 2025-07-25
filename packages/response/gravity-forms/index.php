<?php

declare(strict_types=1);

use HeadlessWpForms\GravityForms\DOFormSubmissionProcessorFacade;

function main(array $args): array
{
    return [
        'body' => (new DOFormSubmissionProcessorFacade())->process($args)->data(),
    ];
}
