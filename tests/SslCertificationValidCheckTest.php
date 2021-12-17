<?php

use Spatie\Health\Enums\Status;
use VictoRD11\SslCertificationHealthCheck\Exceptions\InvalidUrl;
use VictoRD11\SslCertificationHealthCheck\SslCertificationValidCheck;

it('certification is not set url', function () {
    SslCertificationValidCheck::new()->run();
})->throws(InvalidUrl::class, 'When using the `SslCertificationCHeck` you must call `url` to pass the URL you want to ping.');

it('certification is valid', function () {
    $result = SslCertificationValidCheck::new()
        ->url('google.com')
        ->run();

    expect($result->status)->toBe(Status::ok());
});
