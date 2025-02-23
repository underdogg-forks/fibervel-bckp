<?php

namespace Modules\Core\Logging;

use Illuminate\Support\Facades\Log;

class CallLogger
{
    public function log(string $method, string $url, array $data = []): void
    {
        Log::info("API Request: {$method} {$url}", $data);
    }
}
