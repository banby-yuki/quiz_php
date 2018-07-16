<?php

spl_autoload_register(function($class) {
  //'MyApp\\'のバックスラッシュが二本なのはエスケープのために二本で書いてる。
  $prefix = 'MyApp\\';
//strposは第一引数の中に、第二引数を文字列が含まれるかを調べる。=== 0は含まれる文字の開始位置。
//今回は === 0　なので文字が頭から合致しないといけません。という意味。
  if (strpos($class, $prefix) === 0) {
    //substrとstrlen
    //strlenは引数の文字列を文字数にして数字で返す。strlen($prefix)は　$prefix　の中身が MyApp\\(\\はエスケープして1文字の\になる。)
    //なので、6文字だから 6 が入る。
    //substrは第一引数に対象文字列、第二引数に文字列の取り出し開始位置(0なら先頭)、第三引数に取り出す文字のバイト数
    //(半角の数字&文字:1バイト  全角文字:2バイト)
    //
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__ . '/' . $className . '.php';

    if (file_exists($classFilePath)) {
      require $classFilePath;
    } else {
      echo 'No such class: ' . $className;
      exit;
    }
  }
});

 ?>
