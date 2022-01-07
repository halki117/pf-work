# アプリケーション名
『 RELIANCE 』

# 概要
私たちが、気軽にノマドワークや勉強をできるスポットを見つけることができるアプリです。
『 RELIANCE 』という言葉は、「寄りどころ」という意味があります。その意味に因んで命名しました。


# URL
https://www.protfolio-reliance.com


# テスト用アカウント	
  一般ユーザー1(ユーザー名: sample1)

    アドレス: sample1@test.com  パスワード: sample1555

  一般ユーザー2(ユーザー名: sample2)

    アドレス: sample2@test.com  パスワード: sample2555

  管理者ユーザー(ユーザー名: admin)

    アドレス: admin@test.com  パスワード: admin555


# 企画背景、目指した課題解決	
私たちがエンジニアとしてノマドワークや日々の勉強をしたいと思ってネット等で「エンジニア 作業 スペース」のように検索した場合、ほとんどがコワーキングがヒットすると思います。
しかし、コワーキングスペースは利用コストがそれなりに掛かり、気軽に立ち寄って作業がしたい方にとってはハードルが高くなります。
そこで、そういったコワーキングスペース以外で気軽にコストがあまり掛からない場所があればいいなと思いアプリ制作に至りました。
私たちの身近な場所で気軽に赴けて作業に適した場所（例えば、カフェ、ファミレス、公園の休憩スペース等）を投稿して他者と共有できる仕様となっております。


# 洗い出した要件
スプレッドシートに記載
<img src="https://i.gyazo.com/cac780f110da7fc43437535e2ab7e4c2.png">
https://docs.google.com/spreadsheets/d/1BNWOZ2_8p7NNNo-v20AAqWKB_9JSjMfgKz1W7eygtTw/edit#gid=0


# データベース設計
drow.ioにて設計
<img src="https://i.gyazo.com/0e4783695844c2830df5c214a6c51a13.png">
https://app.diagrams.net/#G10ET2lddnibF2Nyy0LJ2k8UlG_d_dOHve


# ネットワーク図
drow.ioにて設計
<img src="https://i.gyazo.com/eab0a4191aec3c9ce40e4de29ca6ca6f.png">
https://app.diagrams.net/#G1b_gKaZOMKqnDX5IB_cWMtltFoZAFy7BP


# アプリの使い方
主に投稿機能、投稿検索機能、管理者機能について説明しています。

- ### 投稿機能（要ログイン）
スポットを投稿できる機能です。ログイン後、画面上の「投稿する」のリンクから投稿画面へ移ることができます。
<img src="https://i.gyazo.com/9ec6d4419332b615f6114c6c733a1ee7.gif">
https://i.gyazo.com/9ec6d4419332b615f6114c6c733a1ee7.mp4

投稿画面で各項目を入力して「投稿する」ボタンを押すことで、投稿が完了します。
<img src="https://i.gyazo.com/b11b8e128ddfd079b824ff8e33793ab8.gif">
https://i.gyazo.com/b11b8e128ddfd079b824ff8e33793ab8.mp4

投稿後のコンテンツはトップページまたはマイページから確認できます。
<img src="https://i.gyazo.com/1593b687c72b948d4332977dfa7ea5f3.gif">
https://i.gyazo.com/1593b687c72b948d4332977dfa7ea5f3.mp4

- ### 検索機能
指定箇所からの周辺からユーザーが投稿したスポットを検索することができます。
画面上「スポットを検索する！」のリンクから検索画面へ遷移できます。
検索条件から検索結果を絞り込むことができます。
<img src="https://i.gyazo.com/666e5d397642ececf342bcc11c26215d.gif">
https://i.gyazo.com/666e5d397642ececf342bcc11c26215d.mp4
- ### 管理者機能 
管理者アカウントでログインすると、画面上に「管理画面」のリンクが現れるので、そこから管理者ページへと移ることができます。
管理者ページでは登録ユーザー・ユーザーの投稿・ユーザーからの問い合わせの一覧を見ることができ、運営からのお知らせを通知することができる
<img src="https://i.gyazo.com/e57514afcdf8f7cf59a472685c0bb442.gif">
https://i.gyazo.com/e57514afcdf8f7cf59a472685c0bb442.mp4

運営からのお知らせ送信後、一般ユーザーで再ログインすると運営からのお知らせ通知を確認することができる。
<img src="https://i.gyazo.com/7679451baed89b06556a177ff16c6db3.gif">
https://i.gyazo.com/7679451baed89b06556a177ff16c6db3.mp4