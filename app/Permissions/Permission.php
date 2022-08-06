<?php

namespace App\Permissions;

class Permission
{
    /*
    * Users Permission
    */
    public const CAN_VIEW_USERS = 'view-users';
    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_UPDATE_USERS = 'update-users';
    public const CAN_DELETE_USERS = 'delete-users';

    /*
    * Categories Permission
    */
    public const CAN_VIEW_CATEGORIES = 'view-categories';
    public const CAN_CREATE_CATEGORIES = 'create-categories';
    public const CAN_UPDATE_CATEGORIES = 'update-categories';
    public const CAN_DELETE_CATEGORIES = 'delete-categories';


    /*
    * Business Settings Permissions
    */
    public const CAN_VIEW_SETTINGS = 'view-settings';
    public const CAN_UPDATE_SETTINGS = 'update-settings';
}
