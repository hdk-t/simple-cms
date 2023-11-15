# simple-cms
Laravel10x学習用のシンプルなCMS

# 仕様
## 機能一覧
- ユーザー 
    - 記事一覧表示
        - サムネイル画像表示
        - タイトル表示
        - タグ表示
    - 記事詳細表示
        - サムネイル画像表示
        - タイトル表示
        - タグ表示
        - 本文表示
            - MarkDown解析表示

- 管理者
    - ログイン
    - ログアウト
    - 管理記事一覧
        - 記事ジャンプ
        - 記事作成
            - サムネイル画像設定
            - タイトル作成
            - タグ設定
            - 本文作成
                - MarkDownで登録
            - プレビュー
            - 下書き保存
        - 記事編集
            - サムネイル画像設定
            - タイトル作成
            - タグ設定
            - 本文作成
                - 画像埋め込みコード変換
            - プレビュー
            - 記事の非公開
            - 記事の削除
    - 管理画像一覧
        - 画像埋め込みコード発行
        - 画像アップロード
        - 画像の削除

## 画面遷移図
```mermaid
graph LR

    subgraph user [ユーザー]
        ヘッダー--"/"-->記事一覧
        /-->記事一覧
        記事一覧--"/articles/show/:id"-->記事詳細
    end
    
    subgraph admin [管理者]
        /admin-->ベーシック認証--"/admin/login"-->パスワード認証画面--"/admin/articles"-->管理記事一覧
        管理者ヘッダー--"/admin/articles"-->管理記事一覧
        管理者ヘッダー--"/admin/images"-->管理画像一覧
        管理者ヘッダー--ログアウト-->パスワード認証画面
        管理記事一覧--"/admin/articles/create"-->記事作成
        記事作成--"/admin/articles/:id/images"-->サムネイル画像設定
        管理記事一覧--"/admin/articles/edit/:id"-->記事編集
        記事編集--"/admin/articles/:id/images"-->サムネイル画像設定
        サムネイル画像設定-->管理記事一覧
        記事編集--"/admin/articles/delete/:id"-->記事削除確認
        記事削除確認-->管理記事一覧
        管理画像一覧--"/admin/images/create"-->画像アップロード
        画像アップロード-->管理画像一覧
        管理画像一覧--"/admin/images/delete/:id"-->画像削除確認
        画像削除確認-->管理画像一覧
    end
```

## ER図
```mermaid
erDiagram

    articles }|--|| article_statuses: "article_statuses_id"
    articles }|--|| images: "images_id"
    article_tags }o--|| articles: "articles_id"
    article_tags }|--|| tags: "tags_id"

    articles {
        bigint id PK
        string title "記事タイトル"
        string images_id "サムネイル画像ID"
        text body "記事本文"
        string article_statuses_id "記事ステータス"
        datetime created_at
        timestamp updated_at
    }

    article_statuses {
        bigint id PK
        string name "ステータス名"
        string sentence "ステータス説明"
        datetime created_at
        timestamp updated_at
    }

    article_tags {
        bigint articles_id "記事ID"
        string tags_id "タグID"
        datetime created_at
        timestamp updated_at
    }

    tags {
        bigint id PK
        string name "タグ名"
        string sentence "タグ説明"
        datetime created_at
        timestamp updated_at
    }

    images {
        bigint id PK
        string path "画像パス"
        boolean is_deleted "削除フラグ"
        datetime created_at
        timestamp updated_at
    }
```

# 開発環境構築
## コンテナを立ち上げる
    docker-compose up -d

## ライブラリインストール
    docker exec -it simple_cms_app composer install

## データベースを作成して初期データを投入
    docker exec -it simple_cms_app php artisan migrate --seed

# テスト実行手順
