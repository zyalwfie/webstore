<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Computed;

class PaymentData extends Data
{
    #[Computed]
    public string $hash;

    public function __construct(
        public string $driver,
        public string $method,
        public string $label,
        public string $payload = [],
    ) {
        $this->hash = md5("{$driver}|{$method}|" . json_encode($payload));
    }
}
