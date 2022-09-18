# laravelプロジェクトのクローン方法
## 事前にhtdocsへ移動
### 1. リモートリポジトリをhtdocs下へクローン  
* git clone [LaravelプロジェクトのURL]
### 2. プロジェクトディレクトリへ移動(recipeApp)
### 3. venderファイルを作成
* composer update
### 4. composerをインストール
* composer install
### 5. .env.exampleをコピペ → .envにリネーム → .envファイルを書き換え
### 6. アプリケーションキーの初期化
* php artisan key:generate

## 以下必要であれば
* php artisan migrate
* php artisan serve