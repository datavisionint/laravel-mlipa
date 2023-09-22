<?php

namespace DatavisionInt\Mlipa\Enums;

enum PayoutStatus:string implements ShouldReturnValues
{
    use ReturnsValues;

    case AWAITING_VERIFICATION = "awaiting_verification";
    case VERIFICATION_FAILED = "verification_failed";
    case PENDING = "pending";
    case SUCCESSFUL = "successful";
    case FAILED = "failed";
}
