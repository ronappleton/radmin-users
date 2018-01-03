<?php

namespace RonAppleton\Radmin\Users\Abstracts;

use RonAppleton\Radmin\Users\Http\Controllers\Controller;
use RonAppleton\Radmin\Users\Contracts\UserResourceInterface;
use Yajra\DataTables\Facades\DataTables;

abstract class UserResourceAbstractController extends Controller implements UserResourceInterface
{
    public function handle($method)
    {
        if(empty($this->$method()))
        {
            throw new NotFoundHttpException;
        }
        return $this->$method();
    }

    public function allUsers()
    {
        $userModel = config('radmin-users.user_model');
        $users = $userModel::orderBy('name', 'ASC')->where('name', '!=', config('radmin-users.super_user_name'))->get();

        return DataTables::collection($users)
            ->addColumn('action', function ($user) {
                $url = route('users.edit', $user->id);
                return "<a href=\"$url\" class=\"btn btn-xs btn-primary\"><i class=\"glyphicon glyphicon-edit\"></i> Edit</a>";
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }
}