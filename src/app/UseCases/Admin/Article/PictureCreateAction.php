<?php

declare(strict_types = 1);

namespace App\UseCases\Admin\Article;

use DB;
use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\ArticleTag;
use App\UseCases\Article\Entities\ArticleEntity;
use App\Http\Requests\Admin\ArticleFormRequest;
use Illuminate\Http\Request;

class PictureCreateAction
{
    public function __invoke(): PictureEntity
    {

    }
}
