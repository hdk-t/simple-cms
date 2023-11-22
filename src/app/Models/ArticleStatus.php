<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleStatus extends Model
{
    use HasFactory;
    public const DRAFT = 1;
    public const PUBLISH = 2;
    public const UNPUBLISHED = 3;
    public const DELETED = 4;
}
