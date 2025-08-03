<?php

namespace App\Repositories;

use App\Interfaces\ContentRepositoryInterface;

class ContentRepository implements ContentRepositoryInterface
{
    public function getContents($model, $scopes = [], $page = null, $list = 'paginate', $conditions = [])
    {
        $data = $model::orderBy('created_at', 'DESC');

        if (isset($scopes) && count($scopes) > 0) {
            foreach ($scopes as $scope) {
                $data = $data->$scope();
            }
        }

        if (isset($conditions['search']) && $conditions['search'] != '') {
            $search = $conditions['search'];

            $data = $data->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%'.$search.'%');
                    $q->orWhere('title', 'like', '%'.$search.'%');
                }
            );
        }

        unset($conditions['search']);
        if (isset($conditions) && isset($conditions['where'])) {
            $data = $data->where($conditions['where']);
        }
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'first') {
            $data = $data->first();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }

        return $data;
    }

    public function getSingleContent($model, $scopes = [], $conditions = [])
    {
        $data = $model::orderBy('created_at', 'DESC');
        if (isset($scopes) && count($scopes) > 0) {
            foreach ($scopes as $scope) {
                $data = $data->$scope();
            }
        }

        if (isset($conditions) && isset($conditions['where'])) {
            $data = $data->where($conditions['where']);
        }

        return $data->first();
    }

    public function getCount($model, $scopes = [], $conditions = [])
    {
        $data = $model::orderBy('created_at', 'DESC');

        if (isset($scopes) && count($scopes) > 0) {
            foreach ($scopes as $scope) {
                $data = $data->$scope();
            }
        }
        if (isset($conditions) && isset($conditions['where'])) {
            $data = $data->where($conditions['where']);
        }

        return $data->count();
    }
}
