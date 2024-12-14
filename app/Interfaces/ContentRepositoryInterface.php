<?php

namespace App\Interfaces;

interface ContentRepositoryInterface
{
    public function getContents($model, $scopes= [], $page= null, $list= null, $conditions= []);

    public function getSingleContent($model, $scopes= [], $conditions=[]);
    public function getCount($model, $scopes= [], $conditions=[]);
}
