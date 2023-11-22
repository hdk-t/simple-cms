<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Picture;
use cebe\markdown\MarkdownExtra;
use Illuminate\Support\Collection;
use Storage;

class MarkdownParseService
{
    /**
     * @var Collection<int, Picture>
     */
    private Collection $pictures;

    public function __construct(Collection $pictures)
    {
        $this->pictures = $pictures;
    }

    public function markdownToHtml(string $markdownText): string
    {
        $text = $this->embedPictureParse($markdownText);
        $converter = new MarkdownExtra();
        $text = $converter->parse($text);
        return $text;
    }

    private function embedPictureParse(string $markdownText): string
    {
        $fulltexts = 0;
        $bodies    = 1;
        preg_match_all('/\[img\](.*?)\[\/img\]/', $markdownText, $matches);
        for ($i = 0; $i < count($matches[$fulltexts]); $i++)
        {
            $pictureId = trim($matches[$bodies][$i]);
            $path = $this->pictures->where('id', $pictureId)->first()?->path;
            if(empty($path))
            {
                $markdownText = str_replace($matches[$fulltexts][$i], '', $markdownText);
                continue;
            }
            $img = '<img height="400" src="'.Storage::url($path).'">';
            $markdownText = str_replace($matches[$fulltexts][$i], $img, $markdownText);
        }
        return $markdownText;
    }
}
