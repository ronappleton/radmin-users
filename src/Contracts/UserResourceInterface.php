<?php
/**
 * Created by PhpStorm.
 * User: ron
 * Date: 12/11/17
 * Time: 11:50 AM
 */

namespace RonAppleton\Radmin\Users\Contracts;


interface UserResourceInterface
{
    public function handle($method);

    public function allUsers();
}