<?php

namespace HaoSheng\Constants;

use ErrorException;
use ReflectionClass;
use ReflectionException;

class ConstantsCollect
{
    /**
     * @param int|string $value
     *
     * @throws ReflectionException
     * @throws ErrorException
     */
    public static function get(string $class, string $annotation, $value): string
    {
        $reflection_class = new ReflectionClass($class);
        $annotations = ConstantsAnalyze::getAnnotations($reflection_class->getReflectionConstants());

        if (! isset($annotations[$value])) {
            throw new ErrorException('No match constant');
        }

        if (! isset($annotations[$value][$annotation])) {
            throw new ErrorException('No match constant');
        }

        return $annotations[$value][$annotation];
    }
}
