# 🍗 dbhelper 🍗

itraxDB is a small php wrapper for mysql/postgres/sqlite databases.

## installation

install once with composer:

```
composer require itrax/db
```

then add this to your project:

```php
require __DIR__ . '/vendor/autoload.php';
use itrax\dbWrapper;
```

## usage

```php
/* connect to database */
// $db->connect('pdo', 'mysql', '127.0.0.1', 'username', 'password', 'database', 3306);
$db = new dbWrapper('127.0.0.1', 'username', 'password', 'database', 3306);

/* insert/update/delete */
$id = $db->insert('tablename', ['col1' => 'foo'])->execute();
$db->update('tablename', ['col1' => 'bar'])->where( ['id' => $id])->excute();
$db->delete('tablename')->where( ['id' => $id])->excute();
/* select */
$db->select('tablename','colums')->getAll();
$db->select('tablename','colums')->getRow();
$db->select('tablename','colums')->where( ['id' => $id])->getRow();
$db->select('tablename','colums')->where( ['id' => $id])->andWhere(['id' => $id])->getRow();
$db->select('tablename','colums')->where( ['id' => $id])->orWhere(['id' => $id])->getRow();
