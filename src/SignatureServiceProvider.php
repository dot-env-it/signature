<?php

declare(strict_types=1);

namespace DotEnvIt\Signature;

use DotEnvIt\Signature\Middleware\InjectSignature;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

final class SignatureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/signature.php', 'signature');
    }

    public function boot(Kernel $kernel)
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/signature.php' => config_path('signature.php'),
            ], 'signature-config');
        }

        $kernel->appendMiddlewareToGroup('web', InjectSignature::class);

        if (config('signature.publish_humans_txt', true) && request()->is('humans.txt')) {
            $this->serveHumansTxt();
        }
    }

    protected function serveHumansTxt()
    {
        $branding = InjectSignature::resolveBranding(request()->getHost());

        $content = "/* TEAM */\n";

        if ($branding['show_name']) {
            $content .= 'Developed by: ' . $branding['name'] . "\n";
        }
        if ($branding['show_company']) {
            $content .= 'Company: ' . $branding['company'] . "\n";
        }
        if ($branding['show_email']) {
            $content .= 'Email: ' . $branding['email'] . "\n";
        }

        $content .= "\n/* SITE */\n";

        if ($branding['show_website']) {
            $content .= 'Site: ' . $branding['website'] . "\n";
        }

        header('Content-Type: text/plain');
        echo $content;
        exit;
    }
}
