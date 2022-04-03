<?php

namespace HaoSheng\Constants;

use ArgumentCountError;
use Error;
use ErrorException;
use Illuminate\Support\Str;
use ReflectionException;

abstract class Constants
{
    /**
     * @param array<integer,mixed> $arguments
     *
     * @throws ReflectionException
     * @throws ErrorException
     */
    public static function __callStatic(string $annotation, array $arguments = []): string
    {
        if (! Str::startsWith($annotation, 'get')) {
            throw new Error('Call to undefined method ' . __CLASS__ . "::{$annotation}()");
        }

        if (count($arguments) === 0) {
            throw new ArgumentCountError('Too few arguments to function ' . __CLASS__ . "::{$annotation}()");
        }

        $value = $arguments[0];
        $annotation = strtolower(substr($annotation, 3));

        return ConstantsCollect::get(static::class, $annotation, $value);
    }
}
