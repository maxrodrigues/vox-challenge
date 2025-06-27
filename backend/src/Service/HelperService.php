<?php

namespace App\Service;

use Exception;

class HelperService
{
    public function hydrate(array $data)
    {
        //
    }
    /**
     * @param array $payload
     * @return void
     * @throws Exception
     */
    public static function checkData(array $payload): void
    {
        if (! $payload) {
            throw new Exception('Request body is empty');
        }
    }

    /**
     * @param $input
     * @return string
     */
    public static function camelCaseToSnakeCase($input)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $input)), '_');
    }

    public static function snakeCaseToCamelCase($input)
    {
        $a = str_replace('_', ' ', $input);
        dd(ucwords($a));
    }
}
