<?php

namespace DatavisionInt\Mlipa\Traits;

use DatavisionInt\Mlipa\Lib\MlipaResponse;

trait PreparesResponses
{
    /**
     * Remove nulls from the response
     *
     * @param MlipaResponse $response
     * @return MlipaResponse
     */
    public function preparedResponse(MlipaResponse $response): MlipaResponse
    {
        $properties = get_object_vars($response);
        foreach ($properties as $property => $value) {
            if ($value == null) {
                unset($response->{$property});
            }
        }
        return $response;
    }
}
