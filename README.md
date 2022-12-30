# docker + Laravel + vue.js で簡単SPA環境構築

# 環境
MacOS Catalina バージョン 10.15.7
Docker version 20.10.12
docker-compose version 1.29.2

# .env.exampleをコピーして.envファイルに変更
- 中身を以下の内容に修正
WEB_PORT=80
DB_PORT=3306

DB_NAME={ここは好きな名前でOK}
DB_USER=admin
DB_PASSWORD=admin
DB_ROOT_PASSWORD=root

# dockerイメージのビルド
docker-compose build --no-cache

- —no-cacheオプションをつけるとエラーが出た時になどにキャッシュを読み込まなくなるのでおすすめです。

# dockerのコンテナ起動
docker-compose up -d
* この時点でmysqlコンテナが起動します

# appコンテナに入る
docker compose exec app bash

# Laravelのインストール
composer create-project --prefer-dist "laravel/laravel=6.*" .
exit

# Laravel Mixファイルの削除
cd backend
rm -rf package.json webpack.mix.js

# vueのビルドファイルの格納先を指定
cd public
mkdir templates
cd templates
touch base.html

# Laravelにルーティング設定
backend/routes/web.phpファイルを開く

以下をの内容に書き換える
Route::get('/{any}', function () {
    return view('spa.app');
})->where('any', '.*');

#gitignore に以下を追記
.gitignore
/public/app
/resources/views/spa

# Vue.jsのインストール
cd ../frontend
npm install -g @vue/cli
# バージョン確認
vue -V

# vue のソースダウンロード
vue create .

# 色々聞かれるのでお好みで設定する
例)自分の場合は以下のようにしました

? Please pick a preset: Manually select features
? Check the features needed for your project: Babel, Router, Linter
? Choose a version of Vue.js that you want to start the project with 2.x
? Use history mode for router? (Requires proper server setup for index fallback in production) Yes
? Pick a linter / formatter config: Basic
? Pick additional lint features: Lint on save
? Where do you prefer placing config for Babel, ESLint, etc.? In dedicated config files
? Save this as a preset for future projects? No

# vue.config.js に以下の内容を追記
module.exports = {
    // アセットはLaravelのpublic/appディレクトリ配下に作成される
    outputDir: '../backend/public/app',

    // app配下にjs, cssなどが置かれるので、publicPathを調整
    publicPath: '/app',

    pages: {
        // appのエントリポイント、テンプレート、出力先を調整
        app: {
            entry: 'src/main.js',
            template: 'templates/base.html',
            filename: `../../resources/views/spa/app.blade.php`,
        },
    },
}

# フロントエンドのbuild
npm run build

# ソースのコピー(今のところ不要かも)
/backend/public/app/index.htmlの内容をtemplates/base.htmlにコピー

# ブラウザより以下のアドレスにアクセスするとvue.jsの画面が表示されていたら成功
http::/localhost:80

