<?php

namespace Lemaur\LaravelTypedConfig;

use Illuminate\Config\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTypedConfigServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-typed-config');
    }

    public function packageBooted(): void
    {
        /**
         * Retrieve value from the configuration as a Stringable instance.
         *
         * @param  string  $key
         * @param  mixed  $default
         * @return \Illuminate\Support\Stringable
         */
        Repository::macro('string', function ($key, $default = null) {
            return str($this->get($key, $default));
        });

        /**
         * Retrieve value from the configuration as a Stringable instance.
         *
         * @param  string  $key
         * @param  mixed  $default
         * @return \Illuminate\Support\Stringable
         */
        Repository::macro('str', function ($key, $default = null) {
            return $this->string($this->get($key, $default));
        });

        /**
         * Retrieve configuration item as a boolean value.
         *
         * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
         *
         * @param  string|null  $key
         * @param  bool  $default
         * @return bool
         */
        Repository::macro('boolean', function ($key = null, $default = false) {
            return filter_var($this->get($key, $default), FILTER_VALIDATE_BOOLEAN);
        });

        /**
         * Retrieve configuration item as an integer value.
         *
         * @param  string  $key
         * @param  int  $default
         * @return int
         */
        Repository::macro('integer', function ($key, $default = 0) {
            return intval($this->get($key, $default));
        });

        /**
         * Retrieve configuration item as a float value.
         *
         * @param  string  $key
         * @param  float  $default
         * @return float
         */
        Repository::macro('float', function ($key, $default = 0.0) {
            return floatval($this->get($key, $default));
        });

        /**
         * Retrieve value from the configuration as a Carbon instance.
         *
         * @param  string  $key
         * @param  string|null  $format
         * @param  string|null  $tz
         * @return \Illuminate\Support\Carbon|null
         *
         * @throws \Carbon\Exceptions\InvalidFormatException
         */
        Repository::macro('date', function ($key, $format = null, $tz = null) {
            if ($this->isNotFilled($key)) {
                return null;
            }

            if (is_null($format)) {
                return Date::parse($this->get($key), $tz);
            }

            return Date::createFromFormat($format, $this->get($key), $tz);
        });

        /**
         * Retrieve value from the configuration as an enum.
         *
         * @template TEnum
         *
         * @param  string  $key
         * @param  class-string<TEnum>  $enumClass
         * @return TEnum|null
         */
        Repository::macro('enum', function ($key, $enumClass) {
            if ($this->isNotFilled($key) ||
                ! enum_exists($enumClass) ||
                ! method_exists($enumClass, 'tryFrom')) {
                return null;
            }

            return $enumClass::tryFrom($this->get($key));
        });

        /**
         * Retrieve value from the configuration as a collection.
         *
         * @param  array|string|null  $key
         * @return \Illuminate\Support\Collection
         */
        Repository::macro('collect', function ($key = null) {
            $value = $this->get($key);

            if (! is_array($value)) {
                $value = Arr::wrap($value);
            }

            return collect($value);
        });

        /**
         * Determine if the given configuration item is an empty string for "filled".
         *
         * @param  string  $key
         * @return bool
         */
        Repository::macro('isEmptyString', function ($key) {
            $value = $this->get($key);

            return ! is_bool($value) && ! is_array($value) && trim((string) $value) === '';
        });

        /**
         * Determine if the value contains a non-empty value for a configuration item.
         *
         * @param  string|array  $key
         * @return bool
         */
        Repository::macro('filled', function ($key) {
            $keys = is_array($key) ? $key : func_get_args();

            foreach ($keys as $value) {
                if ($this->isEmptyString($value)) {
                    return false;
                }
            }

            return true;
        });

        /**
         * Determine if the value contains an empty value for a configuration item.
         *
         * @param  string|array  $key
         * @return bool
         */
        Repository::macro('isNotFilled', function ($key) {
            $keys = is_array($key) ? $key : func_get_args();

            foreach ($keys as $value) {
                if (! $this->isEmptyString($value)) {
                    return false;
                }
            }

            return true;
        });
    }
}
