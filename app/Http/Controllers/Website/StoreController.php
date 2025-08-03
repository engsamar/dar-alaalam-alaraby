<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Interfaces\ContentRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private ContentRepositoryInterface $__contentRepository;
    private $productModel = 'App\Models\Product\Product';

    public function __construct(
        ContentRepositoryInterface $__contentRepository,
    ) {
        $this->__contentRepository = $__contentRepository;
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $productModel = '\App\Models\Product';
        $authorModel = '\App\Models\Product\Author';
        $brandModel = '\App\Models\Product\Brand';
        $categoryModel = '\App\Models\Product\Category';
        $tagModel = '\App\Models\Product\Tag';
        // $condition['data'] = $request->all();
        $condition = [];
        if (isset($data['search']) && $data['search'] != '') {
            $condition['search'] = $data['search'];
        }
        if (isset($data['author']) && $data['author'] != '') {
            $author = $authorModel::whereSlug($data['author'])->first();
            if (!empty($author)) {
                $condition['where']['author_id'] = $author->id;
            }
        }

        if (isset($data['category']) && $data['category'] != '') {
            $category = $categoryModel::whereSlug($data['category'])->first();
            if (!empty($category)) {
                $condition['where']['category_id'] = $category->id;
            }
        }

        if (isset($data['tag']) && $data['tag'] != '') {
            $tag = $tagModel::whereSlug($data['tag'])->first();

            if (!empty($tag)) {
                $condition['whereHas'] = [['tags' => $tag->id]];
            }
        }

        $result['products'] = $this->__contentRepository
            ->getContents($productModel.'\Product', ['Available', 'publish'], 18, 'paginate', $condition);

        $result['categories'] = $this->__contentRepository
            ->getContents($productModel.'\Category', ['Category', 'publish', 'HaveBook'], 100, 'all');

        return view('website.pages.store.index', compact('result'));
    }

    public function show(Request $request, $lang, $slug)
    {
        $result = [];

        $result['item'] = $this->__contentRepository
            ->getSingleContent($this->productModel, ['Available', 'publish'], [
                'where' => ['slug' => $slug],
            ]);

        if (empty($result['item'])) {
            abort(404);
        }

        $result['item']->increment('no_views');

        $shareComponent = \Share::page(
            $result['item']->url,
            $result['item']->title
        )
            ->facebook($result['item']->sub_title)
            ->twitter($result['item']->sub_title)
            ->linkedin($result['item']->sub_title)
            ->telegram($result['item']->sub_title)
            ->whatsapp($result['item']->sub_title)
            ->reddit($result['item']->sub_title)
            ->getRawLinks();
        $result['share'] = $shareComponent;

        $result['items'] = $this->__contentRepository
            ->getContents($this->productModel, ['Available', 'publish'], 8, 'list'); // related

        return view('website.pages.store.show', compact('result'));
    }
}
