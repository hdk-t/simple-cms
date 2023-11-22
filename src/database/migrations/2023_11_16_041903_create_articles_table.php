<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('記事タイトル');
            $table->bigInteger('picture_id')->comment('サムネイル画像ID');
            $table->text('body')->comment('記事本文');
            $table->bigInteger('article_status_id')->comment('記事ステータス');
            $table->datetime('published_at')->nullable()->default(null)->comment('記事公開日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
