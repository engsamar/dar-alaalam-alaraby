<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ContentRepositoryInterface;

class ArticlesController extends Controller
{
    private ContentRepositoryInterface $__contentRepository;
    private $baseModel = '\App\Models\Article\Article';

    public function __construct(
        ContentRepositoryInterface $__contentRepository
    ) {
        $this->__contentRepository = $__contentRepository;
    }
    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();

        if(isset($data['catalogue']))
        {
            $catalogue = $this->__contentRepository
                ->getSingleContent('\App\Models\Article\Catalogue', $request->catalogue);

            if(! empty($catalogue)){
                $data['conditions'] = ['catalogue_id' => $catalogue->id];
            }
        }
        $result['items'] = $this->__contentRepository
            ->getContents($this->baseModel, ['publish'], 12, 'paginate', $data);

        return view('website.pages.articles.index', compact('result'));
    }


    public function show(Request $request,$lang, $slug)
    {
        $result = [];
        $baseModel = 'App\Models\Article\Article';

        $result['item'] = $this->__contentRepository
            ->getSingleContent($this->baseModel, ['publish'], [
                'where' => ['slug' => $slug]
        ]);

        if(! empty($result['item'])) {
            $data['catalogue_id'] = $result['item']->catalogue_id;

            $result['items'] = $this->__contentRepository
                ->getContents($this->baseModel, ['publish'], 5, 'paginate', $data);

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

        }

        $result['catalogues'] = $this->__contentRepository
            ->getContents('\App\Models\Article\Catalogue', ['publish']);

        $result['tags'] = $this->__contentRepository
            ->getContents('\App\Models\Product\Tag', ['Article', 'publish']);

        return view('website.pages.articles.show', compact('result'));
    }
}
