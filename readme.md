# POTI-board EVO 用テーマ

[POTI-board EVO](https://github.com/satopian/poti-kaini) のテーマ開発用リポジトリです。

## MONO_DEV

改二のデフォルトだった「MONO」をちょっといじったやつです。

![img/monodev_i.png](img/monodev_i.png)

- EVO (POTI-board v3.00以降)対応。つまり、ChickenPaint対応。
- 複数パレット対応。
- cssで色の切り替えが可能。

## テーマ変更の仕方

- まず、potiboardがきちんと動いていることを確認します。念のため`config.php`のバックアップを取っておいてください。

1. [releases](https://github.com/sakots/poti-EVO-themes/releases)のページから、ダウンロードします。
2. 解凍したあと、フォルダごと`potiboard.php`と同じところにコピーします。
3. `config.php`で`SKIN_DIR`の値を変更します。MONO_DEVの場合は、theme_monodev/です。

   ``` php:config.php
   define('SKIN_DIR', 'theme_monodev/');

   //define('SKIN_DIR', 'pink/');
   ```

4. `config.php`と`theme_monodev`フォルダをアップロードします。
5. 管理画面から「更新」で、OK！

## 更新履歴

### [2021/06/04] MONO_DEV v2.1.2

- しぃペインターが起動できない問題に暫定対処。

### [2021/05/29]

- リリース用にパッケージを作った。
- readmeにテーマ変更の仕方追記。

### [2021/05/29] MONO_DEV v2.1.1

- 数字のみ入力できるテキストボックスのスピンボタンを消した。
- script整理。
- 著作権表記のところ微修正。

### [2021/05/26] MONO_DEV v2.1.0

- 色の変更をプルダウンメニューにした。

### [2021/05/26]

- リポジトリ生やした。
- monodev 2.0.0
