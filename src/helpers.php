<?php

if (!function_exists('getUserTableName')) {
    /**
     * @return string
     */
    function getUserTableName()
    {
        /**
         * Pull model string from config
         */
        $model = config('laravel-user-management-module.user_model');

        /**
         * Instantiate a new model
         */
        $instance = new $model();

        /**
         * Find the table name
         */
        $table = $instance->getTable();

        /*
         * return table name (default of users if $table is empty
         */
        return empty($table) ? 'users' : $table;
    }
}