<?php

use Carbon\Carbon;

// function totalPrice($price, $discount)
// {
//     return $price - $discount;
// }

function price($price)
{
    return '€'.number_format(($price / 100), 2);
}
