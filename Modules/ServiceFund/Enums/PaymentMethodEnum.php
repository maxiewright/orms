<?php

namespace Modules\ServiceFund\Enums;

enum PaymentMethodEnum: int
{
    case Cash = 1;
    case Cheque = 2;
    case BankTransfer = 3;

}
