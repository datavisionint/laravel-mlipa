<?php

namespace DatavisionInt\Mlipa\Enums;

enum MlipaApiRequestLogType: string implements ShouldReturnValues
{
    use ReturnsValues;

    case API_CALL = "api_call";
    case WEBHOOK = "webhook";

}
