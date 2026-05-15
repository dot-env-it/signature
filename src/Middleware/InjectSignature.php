<?php

namespace DotEnvIt\Signature\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectSignature
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Check global enable/disable
        if (!config('signature.enabled', true)) {
            return $response;
        }

        $branding = self::resolveBranding($request->getHost());

        // 1. HTTP Header injection
        if (($branding['add_to_header'] ?? false)) {
            $response->headers->set('X-Developed-By', $branding['header'] ?? 'dot-env-it');
        }

        // 2. HTML Comment injection
        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();
            $parts = array_filter([
                ($branding['show_name'] ?? false) ? $branding['name'] : null,
                ($branding['show_company'] ?? false) ? $branding['company'] : null,
                ($branding['show_website'] ?? false) ? $branding['website'] : null,
                ($branding['show_email'] ?? false) ? $branding['email'] : null,
            ]);

            if (!empty($parts)) {
                $signature = "\n\n<!--\n Developed by: " . implode(' | ', $parts) . "\n-->\n";
                $response->setContent($content . $signature);
            }
        }

        return $response;
    }

    public static function resolveBranding(string $host): array
    {
        $default = config('signature.default', []);
        $hosts   = config('signature.hosts', []);

        // Look for a specific pattern match
        foreach ($hosts as $pattern => $override) {
            if (fnmatch($pattern, $host)) {
                // Merge override into defaults
                return array_merge($default, $override);
            }
        }

        return $default;
    }


    protected function isHtmlResponse(Response $response): bool
    {
        return $response instanceof \Illuminate\Http\Response &&
            str_contains($response->headers->get('Content-Type'), 'text/html');
    }
}
