<?php

use Spatie\Health\Enums\Status;
use VictoRD11\SslCertificationHealthCheck\Exceptions\InvalidUrl;
use VictoRD11\SslCertificationHealthCheck\SslCertificationExpiredCheck;

it('certification is not set url', function () {
    SslCertificationExpiredCheck::new()->run();
})->throws(InvalidUrl::class, 'When using the `SslCertificationCHeck` you must call `url` to pass the URL you want to ping.');

it('certification is not expired', function () {
    $result = SslCertificationExpiredCheck::new()
        ->url('google.com')
        ->run();

    expect($result->status)->toBe(Status::ok());
});

it('certification will expire with warning', function () {
    $result = SslCertificationExpiredCheck::new()
        ->url('google.com')
        ->warnWhenSslCertificationExpiringDay(9999)
        ->run();

    expect($result->status)->toBe(Status::warning());
});

it('certification will expire with fail', function () {
    $result = SslCertificationExpiredCheck::new()
        ->url('google.com')
        ->failWhenSslCertificationExpiringDay(9999)
        ->run();

    expect($result->status)->toBe(Status::failed());
});

it('certification is expired with fail', function () {
    $result = SslCertificationExpiredCheck::new()
        ->url('expired.badssl.com')
        ->run();

    expect($result->status)->toBe(Status::failed());
});
