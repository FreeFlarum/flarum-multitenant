<?php

namespace App\Extend;

use App\Mail\SmtpDriver;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;

class ModifyMailDrivers implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container->extend('mail.supported_drivers', function (array $drivers) {
            Arr::forget($drivers, 'mail');

            $drivers['smtp'] = SmtpDriver::class;

            return $drivers;
        });
    }
}
