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

## ライセンスについて

わかりにくいと思うので説明。

以下を守っていただければ、自由に改造、再配布していただいて大丈夫です、というかしてください。

- わたし(`sakots`または`さこつ`)の著作権表記を消さないこと。
- Githubのこのページへのリンクを貼ること。
- 一緒にダウンロードできる`LISENCE`ファイるには一切手を加えないこと。（このライセンスの定義ですので）

また、こんな改造しました！と教えていただければむしろ嬉しいのでどんどんやってください。

---

## 更新履歴

### [2021/06/20] MONO_DEV v2.3.0

- ChickenPaintでペイント画面が選択される問題に対処、その他(by さとぴあ)
- css切り替えで背景がうまく変わらない問題に対処

### [2021/06/13] MONO_DEV v2.2.2

- NEOとしぃペインターの時は、Windows inkや2本指のジェスチャーによるブラウザバックを無効にする。(by さとぴあ)
  - 逆に言えば、chikenpaintでは2本指操作が使えるわけですな。

### [2021/06/08] MONO_DEV v2.2.1

- 細かな修正(by さとぴあ)
  - NEOの作者表記をfunigeに。
  - 現在は変更済みのバグに対する対処を削除。
  - しぃペインターとChickenPaintを使用しない設定の時にJava版のPaintBBSが起動していたのを修正。

### [2021/06/04] MONO_DEV v2.2.0

- POTI-board EVO v3.01.9対応。
  - 管理画面を2000件単位でページできるようになった。
  - v2.1.2のしぃペインターが起動できない問題を解決。

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
