<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CRUDRepositoryInterface;
use App\Http\Requests\ProductSettingsRequest;

class ProductSettingsController extends Controller
{
    private CRUDRepositoryInterface $itemRepository;
    private $path = 'settings';
    private $folderPath = 'product.';
    private $model = 'App\Models\Product\Product';
    private $colorModel = 'App\Models\Product\ProductColor';
    private $sizeModel = 'App\Models\Product\ProductSize';

    /**
     * Instantiate a new controller instance.
    */
    public function __construct(CRUDRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }


    public function edit($id)
    {
        $item = $this->itemRepository->getItemById($this->model, $id);

        $result['sizes'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Size','Publish');

        $result['colors'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Color', 'Publish');


        return view('admin.'.$this->folderPath.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function update(Request $request, $id)
    {

        $item = $this->itemRepository->getItemById($this->model, $id);

        $data = $request->except(['_token', '_method' ]);


        $this->colorModel::where('product_id', $id)->delete();
        $this->sizeModel::where('product_id', $id)->delete();

        foreach($request->sizes as $size){
            $sizeItem = $this->itemRepository->getItemById('App\Models\Product\Size', $size['size_id']);
            $size['product_id'] =  $id;
            $size['title']= $sizeItem->title ?? '';

            $productSize = $this->sizeModel::create($size);
            //colors
            foreach($size['color_id'] as $color){
                $added = [];
                $colorItem = $this->itemRepository->getItemById('App\Models\Product\Color', $color);
                $added['title']= $colorItem->title ?? '';
                $added['color_code']= $colorItem->color_code ?? '';
                $added['product_id'] =  $id;
                $added['size_id'] =  $productSize->id;
                $added['color_id'] =  $color;
                $this->colorModel::create($added);

            }
        }
        $request->session()->flash('success', __('titles.UpdatedMessage'));

        return redirect()->back();
    }

    public function addItem()
    {
        $index = (int)(app('request')->input('index')) + 1;
        $result['sizes'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Size','Publish');

        $result['colors'] = $this->itemRepository
            ->getAllItemsWithScope('App\Models\Product\Color', 'Publish');

        $productSetting =  (object)  ['color_id' => [],'size_id' => '', 'quantity' => '', 'weight' => '', 'price' => ''];
        return view('admin.'.$this->folderPath.$this->path.'.items', compact('index', 'result', 'productSetting'))->render();
    }

}
