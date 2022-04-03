<?php

namespace HaoSheng\Constants;

use Illuminate\Support\Str;
use ReflectionClassConstant;

class ConstantsAnalyze
{
    /**
     * @param array<int,ReflectionClassConstant> $class_constants
     *
     * @return array<int|string,array<string,string>>
     */
    public static function getAnnotations(array $class_constants): array
    {
        $result = [];

        foreach ($class_constants as $class_constant) {
            $value = $class_constant->getValue();
            $doc_comment = $class_constant->getDocComment();

            if ($doc_comment && (is_int($value) || is_string($value))) {
                $result[$value] = self::analyzeDocComment($doc_comment, $result[$value] ?? []);
            }
        }

        return $result;
    }

    /**
     * @param array<string,string> $previous
     *
     * @return array<string,string>
     */
    public static function analyzeDocComment(string $doc_comment, array $previous = []): array
    {
        $pattern = '/@(\\w+)\\("(.+)"\\)/U';

        if (preg_match_all($pattern, $doc_comment, $matches)) {
            if (isset($matches[1], $matches[2])) {
                $keys = $matches[1];
                $values = $matches[2];

                foreach ($keys as $i => $key) {
                    if (isset($values[$i])) {
                        $previous[Str::lower($key)] = $values[$i];
                    }
                }
            }
        }

        return $previous;
    }
}
