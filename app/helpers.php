<?php

function get_db_config()
{
    if (getenv('IS_IN_HEROKU')) {
        $url = parse_url(getenv("DATABASE_URL"));
        return $dbConfig = [
            'connection' => 'pgsql',
            'host' => $url["host"],
            'database' => substr($url["path"], 1),
            'username' => $url["user"],
            'password' => $url["pass"]
        ];
    } else {
        return $dbConfig = [
            'connection' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', '')
        ];
    }
}
