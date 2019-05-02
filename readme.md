__LEVEL TEST__

CodeIgniter + AdminLte + Mysql


MYSQL ----
create user 'testuser'@'localhost' identified by '1111' 

grant all privileges on *.* to 'testuser'@'localhost'; 

create database test_db

grant all privileges on test_db.* to 'testuser'@'localhost';

\'
mysql> desc Tbl_admin_user ;
+--------+-------------+------+-----+---------+----------------+
| Field  | Type        | Null | Key | Default | Extra          |
+--------+-------------+------+-----+---------+----------------+
| n_key  | int(11)     | NO   | PRI | NULL    | auto_increment |
| id_v   | varchar(20) | NO   |     |         |                |
| pw_v   | varchar(20) | NO   |     | Y       |                |
| name_v | varchar(30) | NO   |     |         |                |
+--------+-------------+------+-----+---------+----------------+

mysql> Tbl_customer_info
+---------+-------------+------+-----+---------+----------------+
| Field   | Type        | Null | Key | Default | Extra          |
+---------+-------------+------+-----+---------+----------------+
| c_idx   | int(11)     | NO   | PRI | NULL    | auto_increment |
| date_in | varchar(20) | NO   |     |         |                |
| c_name  | varchar(20) | NO   |     |         |                |
| mphone  | varchar(30) | NO   |     |         |                |
| result  | char(2)     | NO   |     |         |                |
| g_idx   | varchar(11) | NO   |     |         |                |
+---------+-------------+------+-----+---------+----------------+

mysql> desc Tbl_level_temporary ;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| t_idx    | int(11)     | NO   | PRI | NULL    | auto_increment |
| date_in  | varchar(20) | NO   |     |         |                |
| c_idx    | varchar(11) | NO   |     |         |                |
| increase | int(10)     | YES  |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+

mysql> desc Tbl_leveltest_result ;
+--------------+-------------+------+-----+---------+----------------+
| Field        | Type        | Null | Key | Default | Extra          |
+--------------+-------------+------+-----+---------+----------------+
| r_idx        | int(11)     | NO   | PRI | NULL    | auto_increment |
| c_idx        | varchar(11) | NO   |     |         |                |
| b_idx        | varchar(11) | NO   |     |         |                |
| b_result_val | varchar(10) | NO   |     |         |                |
| g_idx        | varchar(11) | NO   |     |         |                |
+--------------+-------------+------+-----+---------+----------------+

mysql> desc Tbl_pro_ans ;
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| n_ans      | int(11)      | NO   | PRI | NULL    | auto_increment |
| pro_n_auto | int(11)      | NO   | MUL | NULL    |                |
| group_v    | tinyint(4)   | NO   | MUL | NULL    |                |
| ans_num_v  | tinyint(4)   | NO   |     | NULL    |                |
| ans_str    | varchar(100) | NO   |     |         |                |
| next_q     | int(11)      | NO   |     | NULL    |                |
| n_result   | int(11)      | NO   |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+

mysql> desc Tbl_pro_group ;
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| group_v     | int(11)      | NO   | PRI | NULL    | auto_increment |
| group_title | varchar(100) | NO   |     |         |                |
+-------------+--------------+------+-----+---------+----------------+

mysql> desc Tbl_pro_result ;
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| n_result   | int(11)      | NO   | PRI | NULL    | auto_increment |
| group_v    | tinyint(4)   | NO   | MUL | NULL    |                |
| title_v    | varchar(100) | NO   |     |         |                |
| msg_v      | text         | NO   |     | NULL    |                |
| img_1      | varchar(100) | NO   |     |         |                |
| img_1_link | varchar(200) | NO   |     |         |                |
| img_2      | varchar(100) | NO   |     |         |                |
| img_2_link | varchar(200) | NO   |     |         |                |
| level_key  | char(2)      | NO   |     |         |                |
+------------+--------------+------+-----+---------+----------------+

mysql> desc Tbl_problem ;
+--------------+--------------+------+-----+---------+----------------+
| Field        | Type         | Null | Key | Default | Extra          |
+--------------+--------------+------+-----+---------+----------------+
| n_auto       | int(11)      | NO   | PRI | NULL    | auto_increment |
| group_v      | tinyint(4)   | NO   | MUL | NULL    |                |
| num_v        | tinyint(4)   | NO   |     | NULL    |                |
| question_str | varchar(200) | NO   |     |         |                |
+--------------+--------------+------+-----+---------+----------------+

mysql> desc `Tbl_lv_memo` ;
+-----------+-------------+------+-----+---------+----------------+
| Field     | Type        | Null | Key | Default | Extra          |
+-----------+-------------+------+-----+---------+----------------+
| m_idx     | int(11)     | NO   | PRI | NULL    | auto_increment |
| c_idx     | varchar(11) | NO   |     |         |                |
| date_in   | varchar(20) | NO   |     |         |                |
| memo_body | text        | YES  |     | NULL    |                |
+-----------+-------------+------+-----+---------+----------------+

\'

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
