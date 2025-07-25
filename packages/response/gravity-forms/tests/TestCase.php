<?php

declare(strict_types=1);

namespace HeadlessWpForms\GravityForms\Tests;

// phpcs:ignore SlevomatCodingStandard.Classes.RequireAbstractOrFinal.ClassNeitherAbstractNorFinal
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function normalizeRawFormData(string $body): string
    {
        return str_replace("\n", "\r\n", $body);
    }
}
