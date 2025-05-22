## 目次
1. 作成したアプリについて
2. 使用技術
3. 実装機能
4. 工夫点
5. 苦労した点
6. 今後の課題について

## 1. 作成したアプリについて
URL：https://xs884273.xsrv.jp/
GitHub：https://github.com/shinnosuke1465/textbook-sales

### 概要
この教科書販売アプリは、学生向けに、中古または新品の教科書を売買できるプラットフォームです。
出品者は不要になった教科書を販売し、購入者は必要な教科書を手頃な価格で入手できます。

### トップページ
<img width="1403" alt="スクリーンショット 2025-05-22 10 02 22" src="https://github.com/user-attachments/assets/95125c8e-2468-48d5-996c-fb8d19dd3d82" />


### 検索フォーム
教科書は、検索フォームからキーワード、大学名、学部名、教科書名の項目から絞り込んで検索することができます。↓
![textbook.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/02ec5c13-a4f0-a9e2-92f6-8aa9d3ae5800.gif)

### 出品した商品一覧
![スクリーンショット 2025-02-09 19.42.40.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/cc6b2775-9dfb-ad2c-0bed-71936c027e47.png)

### 商品出品画面
・会員登録で選択した大学・学部が紐づくようになっている↓
![スクリーンショット 2025-02-09 19.43.14.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/a8ed7861-ccb1-07bc-a539-836fbaf54504.png)

### 購入した商品一覧画面
![スクリーンショット 2025-02-09 19.44.26.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/e0f4002c-8870-b1d5-a582-658d6b879746.png)

### プロフィール編集画面
![スクリーンショット 2025-02-09 19.44.44.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/86f7ae04-844b-39f8-28cb-d337b843279a.png)

### 取引一覧画面
![スクリーンショット 2025-02-09 19.45.38.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/1e20c039-ec8a-bce4-fb38-9351c4ef3733.png)

### 取引画面
![textbook-transaction.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/ade2aecd-4b88-35d7-45ef-2d2d2f8e9b92.gif)

### 掲示板
![スクリーンショット 2025-02-09 19.55.15.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/a138f830-aef8-5982-17fb-5673be5f8d98.png)

### ログイン画面
会員登録で大学・学部の選択必須 (現在名古屋の大学のみ登録してあるが、大学リストに在籍している大学がなければ新たに追加可能)。↓

![register.gif](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/62485c76-e420-a7cb-96f9-a0d03b7bc5dc.gif)

### 商品詳細画面
![スクリーンショット 2025-02-09 20.22.36.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/a9e734e4-1299-a2d4-b734-00e107aa47ac.png)

### 商品購入画面
#現在payjpの本番利用申請を行なっており、購入できるまで数日かかる。
![スクリーンショット 2025-02-09 20.23.00.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/3a66a635-9de7-b44f-bd0a-cab2a0d79eb7.png)


## 2. 使用技術
#### 1.フロントエンド
HTML
CSS
Tailwind CSS
JavaScript
jQuery
Blade (Laravel)

#### 2.バックエンド
PHP 8.1.11 
Laravel 10.10

#### インフラ
mysql
Docker / Docker compose(開発環境)
Xserver
#### その他の使用技術
git(gitHub) / Visual Studio Code
Drawio

## 3. 実装機能
|             |*機能*                  |
|----------|--------------------------|
|1  |教科書の出品     |
|2|教科書の検索・閲覧|
|3|教科書の購入|
|4|チャット機能|
|5|購入履歴・売上管理|
|6|ユーザー登録・ログイン|
|7|同じ学部専用の掲示板|
|8|パスワード変更機能|
|9|レスポンシブ対応|

### ER図
![スクリーンショット 2025-02-09 20.09.20.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/3457929/c9821b40-d667-2891-e1c3-e0387f7abaec.png)

## 4.工夫点
取引後のチャット機能

#### メルカリとの差別化
✅ 大学生専用のプラットフォーム
・会員登録で大学・学部の選択必須 (現在名古屋の大学のみ登録してあるが、大学リストに在籍している大学がなければ新たに追加可能)
・学部ごとの掲示板機能 → 試験対策や授業情報を共有
✅ 教科書特化の検索機能
・大学・学部・教科書名で絞り込み検索が可能
・授業ごとに必要な教科書を探しやすい


## 5.苦労した点
テーブル設計
データベース設計の基礎を理解するのに時間がかかったのと、テーブル間の関係性や属性の適切な定義に苦労しました。
技術ブログなどを見たりしながら理解しました。

デプロイ
安価かつ高速な環境を求め、Xserverを選択

## 6. 今後の課題について
ポートフォリオが一旦完成して、実際に使用して頂いた上での今後の課題としては下記があるかなと思っております。

✅ セキュリティ面の強化
✅ 売上金の管理
・売上金の出金方法の整備
・取引キャンセル時の払い戻し処理
✅ レビュー機能の追加 
・出品者や購入者の評価を付けられるようにする
✅ 配送オプションの追加 
・直接受け取り以外に配送手段を追加
✅ 書いたコードのリファクタリング
✅ インフラ面の基礎理解(AWS)

