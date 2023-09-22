<?php

namespace DatavisionInt\Mlipa\Enums;

enum CollectionStatus:string implements ShouldReturnValues
{
    use ReturnsValues;

    case PENDING = "pending";
    case SUCCESSFUL = "successful";
    case FAILED = "failed";
}
