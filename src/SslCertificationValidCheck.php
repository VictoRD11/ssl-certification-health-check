<?php

declare(strict_types=1);

namespace VictoRD11\SslCertificationHealthCheck;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;
use Spatie\SslCertificate\SslCertificate;
use VictoRD11\SslCertificationHealthCheck\Exceptions\InvalidUrl;

class SslCertificationValidCheck extends Check
{
    public ?string $url = null;

    /**
     * @param string $url
     *
     * @return $this
     */
    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Result
     */
    public function run(): Result
    {
        if ($this->url === null) {
            throw InvalidUrl::make();
        }

        $certificate = SslCertificate::createForHostName($this->url);
        $valid = $certificate->isValid();

        $result = Result::make()
            ->meta(['valid' => $valid])
            ->shortSummary('SSL Certification valid');

        if (! $valid) {
            return $result->failed('SSL Certification is not valid');
        }

        return $result->ok();
    }
}
