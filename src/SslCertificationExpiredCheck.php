<?php

declare(strict_types=1);

namespace VictoRD11\SslCertificationHealthCheck;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;
use Spatie\SslCertificate\SslCertificate;
use VictoRD11\SslCertificationHealthCheck\Exceptions\InvalidUrl;

class SslCertificationExpiredCheck extends Check
{
    public ?string $url = null;
    protected int $warningThreshold = 20;
    protected int $errorThreshold = 14;

    /**
     * @param int $day
     *
     * @return $this
     */
    public function warnWhenSslCertificationExpiringDay(int $day): self
    {
        $this->warningThreshold = $day;

        return $this;
    }

    /**
     * @param int $day
     *
     * @return $this
     */
    public function failWhenSslCertificationExpiringDay(int $day): self
    {
        $this->errorThreshold = $day;

        return $this;
    }

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

        $certificate = SslCertificate::createForHostName($this->url, 30, false);
        $daysUntilExpired = $certificate->daysUntilExpirationDate();

        $result = Result::make()
            ->meta(['days_until_expired' => $daysUntilExpired])
            ->shortSummary($daysUntilExpired . ' days until');

        if ($certificate->isExpired()) {
            return $result->failed('The certificate has expired');
        }

        if ($daysUntilExpired < $this->errorThreshold) {
            return $result->failed("SSL certificate for {$this->url} expires soon ({$daysUntilExpired} days until)");
        }

        if ($daysUntilExpired < $this->warningThreshold) {
            return $result->warning("SSL certificate for {$this->url} expires soon ({$daysUntilExpired} days until)");
        }

        return $result->ok();
    }
}
