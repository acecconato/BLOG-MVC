<?php

return array(
    // Database connection configuration
    "db_hostname"   => "localhost",
    "db_name"       => "perso_blog",
    "db_user"       => "root",
    "db_password"   => "",

    "default_sql_type" => "mysql", // Default SQL type for creating database connections
    "default_picture_posts_path"  => dirname(__DIR__, 2)."/public/image/posts" // Default path where pictures of posts are stocked
);