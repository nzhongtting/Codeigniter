CodeIgniter + AdminLte + Mysql


MYSQL ----
create user 'testuser'@'localhost' identified by '1111' 

grant all privileges on *.* to 'testuser'@'localhost'; 

create database test_db

grant all privileges on test_db.* to 'testuser'@'localhost';


CREATE TABLE `Tbl_admin_user` (
  `n_key` int(11) NOT NULL AUTO_INCREMENT,
  `id_v` varchar(20) NOT NULL DEFAULT '',
  `pw_v` varchar(20) NOT NULL DEFAULT 'Y',
  `name_v` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`n_key`)
) ENGINE=MyISAM CHARSET=utf8

Remove "index.php"  ----
1) create file /CI/.htaccess 

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>

#> chmod 777 .htaccess  

2) set-up "apache2.conf"

<Directory /home/testuser/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>

3) set-up  CodeIgnigter "application/config/config.php"

$config['index_page'] = '';
