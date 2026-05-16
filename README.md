# Signature for Laravel

<picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://banners.beyondco.de/Signature.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&theme=dark&packageManager=composer+require&packageName=dot-env-it%2Fsignature&description=Customizable+host-based+branding+for+Laravel&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg">
    <img src="https://banners.beyondco.de/Signature.png?pattern=topography&style=style_2&fontSize=100px&md=1&showWatermark=1&theme=light&packageManager=composer+require&packageName=dot-env-it%2Fsignature&description=Customizable+host-based+branding+for+Laravel&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Signature">
</picture>

[![Latest Stable Version](https://img.shields.io/packagist/v/dot-env-it/signature.svg?style=flat-square)](https://packagist.org/packages/dot-env-it/signature)
[![Total Downloads](https://img.shields.io/packagist/dt/dot-env-it/signature.svg?style=flat-square)](https://packagist.org/packages/dot-env-it/signature)
[![License](https://img.shields.io/packagist/l/dot-env-it/signature.svg?style=flat-square)](https://packagist.org/packages/dot-env-it/signature)

**Signature** is a lightweight Laravel package that allows you to inject developer credits, company branding, and contact information into your application's HTTP headers, HTML source code, and a virtual `humans.txt` file—all based on the current request host.

## Features

* **Dynamic Branding:** Different signatures for different domains/subdomains using wildcards (e.g., `dev.*` vs `*`).
* **Zero-File `humans.txt`:** Automatically generates a `humans.txt` route without cluttering your `public/` folder.
* **Stealth Headers:** Adds custom `X-Developed-By` headers to every response.
* **HTML Injection:** Appends a clean developer credit comment to the bottom of your HTML source.
* **Fully Configurable:** Easily enable/disable features via `.env` or the published config file.

---

## Installation

You can install the package via composer:

```bash
composer require dot-env-it/signature

```

The service provider will automatically register itself.

### Publish Configuration

Publish the config file to customize your branding:

```bash
php artisan vendor:publish --tag="signature-config"

```

---

## Configuration

After publishing, you can manage your default signature in your `.env` file:

```env
SIGNATURE_ENABLED=true
SIGNATURE_NAME="Jagdish Patel"
SIGNATURE_COMPANY="Dot Env IT"
SIGNATURE_URL="https://github.com/dot-env-it"
SIGNATURE_EMAIL="jagdish.j.ptl@gmail.com"
SIGNATURE_HEADER="powered-by-dot-env-it"

```

### Advanced Host Matching

In `config/signature.php`, you can define specific branding for different environments or tenants:

```php
'hosts' => [
    'staging.*' => [
        'name'   => 'QA Team',
        'header' => 'staging-environment',
    ],
    'admin.*' => [
        'show_signature' => false, // Hide signature on admin subdomains
    ],
],

```

---

## Usage

### 1. HTTP Headers

Once installed, all web responses will include:
`X-Developed-By: powered-by-dot-env-it` (Customizable in config).

### 2. HTML Source

At the bottom of your rendered HTML, you will see():

```html
<!--
 Developed by: Jagdish Patel | dot-env-it | https://github.com/dot-env-it | jagdish.j.ptl@gmail.com
-->
```

### 3. Humans.txt

Visit `your-site.test/humans.txt` to see your machine-readable developer credits.

---

## Security

If you discover any security-related issues, please email [jagdish.j.ptl@gmail.com](mailto:jagdish.j.ptl@gmail.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
