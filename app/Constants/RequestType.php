<?php

namespace App\Constants;

final class UserType
{
    const FRIEND_REQUEST = 0;
    const DELETE_ACCOUNT = 1;

    public static function getList()
    {
        return [
            UserType::FRIEND_REQUEST => 'friend request',
            UserType::DELETE_ACCOUNT => 'delete account',
        ];
    }

    public static function GetOne($id)
    {
        return  UserType::getList()[$id];
    }
}
