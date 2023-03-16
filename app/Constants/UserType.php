<?php

namespace App\Constants;

final class UserType
{
    const CLIENT = 0;
    const ADMIN = 1;

    public static function getList()
    {
        return [
            UserType::CLIENT => trans('translation.CLIENT'),
            UserType::ADMIN => trans('translation.ADMIN')
        ];
    }
}