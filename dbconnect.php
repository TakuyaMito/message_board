<?php

function getDb() : PDO {
  $dsn = 'mysql:dbname=board;host=localhost;charset=utf8';
  $usr = 'root';
  $password = 'root';

  // データベースへ接続
  $db = new PDO($dsn, $usr, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}