<?php

declare(strict_types=1);

namespace VictoRD11\SslCertificationHealthCheck\Exceptions;

use RuntimeException;

class InvalidUrl extends RuntimeException
{
    public static function make(): self
    {
        return new self('When using the `SslCertificationCHeck` you must call `url` to pass the URL you want to ping.');
    }
}
