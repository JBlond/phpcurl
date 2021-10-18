<?php

namespace jblond\phpcurl;

use JsonException;

class Decoder
{
    /**
     * @param $data
     * @return array
     */
    public function jsonToArray($data): array
    {
        try {
            $content = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            return [
                'error' => $exception->getMessage()
            ];
        }
        return $content;
    }
}
