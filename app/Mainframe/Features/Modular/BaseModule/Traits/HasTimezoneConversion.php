<?php /** @noinspection ALL */

namespace App\Mainframe\Features\Modular\BaseModule\Traits;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTimezoneConversion
{

    /**
     * Common datetime attribute handler with timezone conversion
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function dateTimeAttribute(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? $this->convertToUserTz($value) : null,
            set: fn($value) => $value ? $this->convertToSystemTz($value) : null,
        );
    }

    /**
     * Convert datetime from UTC to user's timezone
     *
     * @param  mixed  $value
     * @return string|null
     */
    protected function convertToUserTz($value): ?string
    {
        if (!$value) {
            return null;
        }

        $userTimezone = $this->getUserTimezone();

        return Carbon::parse($value, config('app.timezone'))
            ->setTimezone($userTimezone)
            ->format(DateTimeInterface::ATOM);
    }

    /**
     * Convert datetime from user's timezone to UTC for storage
     *
     * @param  mixed  $value
     * @return string|null
     */
    protected function convertToSystemTz($value): ?string
    {
        if (!$value) {
            return null;
        }

        $userTimezone = $this->getUserTimezone();

        // return Carbon::parse($value, $userTimezone)->utc()->toDateTimeString(); // Convert to UTC
        return Carbon::parse($value, $userTimezone)
            ->setTimezone(config('app.timezone'))->toDateTimeString();
    }

    /**
     * Get user's timezone
     *
     * @return string
     */
    protected function getUserTimezone(): string
    {
        // Customize based on your application's timezone storage strategy
        // return 'Asia/Dhaka';

        // Option 1: Timezone from current authenticated user
        $user = user();
        if ($user && isset($user->timezone) && strlen($user->timezone)) {
            return $user->timezone;
        }

        // Option 2: Timezone from session
        if (session('timezone')) {
            return session('timezone');
        }

        // Option 3: If this user has a timezone property
        if (isset($this->attributes['timezone'])) {
            return $this->attributes['timezone'];
        }

        // Default fallback
        return config('app.timezone');
    }
}