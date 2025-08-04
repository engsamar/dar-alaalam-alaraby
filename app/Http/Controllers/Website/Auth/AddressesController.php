<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Interfaces\ContentRepositoryInterface;
use App\Interfaces\CRUDRepositoryInterface;
use App\Models\User\Address;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    private CRUDRepositoryInterface $__itemRepository;
    private ContentRepositoryInterface $__contentRepository;

    private $__city_model = 'App\Models\City';
    private $__model = 'App\Models\User\Address';
    private $__path = 'addresses';

    public function __construct(
        CRUDRepositoryInterface $__itemRepository,
        ContentRepositoryInterface $__contentRepository,
    ) {
        $this->__itemRepository = $__itemRepository;
        $this->__contentRepository = $__contentRepository;
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $data['conditions']['user_id'] = auth()->user()->id;
        $counts = $this->__itemRepository->getCount($this->__model, $data);
        $items = $this->__itemRepository->getPaginateItems($this->__model, $data);
        $result = [
            'items' => $items,
            'counts' => $counts,
        ];

        return view(
            'auth.addresses.index',
            compact('result')
        );
    }

    public function create(Address $address)
    {
        $result['item'] = $address;
        $result['cities'] = $this->__contentRepository
            ->getContents($this->__city_model, ['City', 'publish'], 300, 'all');

        return view('auth.addresses.create_and_edit', compact('result'));
    }

    public function store(AddressRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->__path);
        }
        $this->__itemRepository->createItem($this->__model, $data, true);

        toastr()->success(__('titles.AddedMessage'));

        return redirect()->route('website.auth.addresses.index', ['locale' => app()->getLocale()]);
    }

    public function show($locale, $id)
    {
        $result = [];
        $result['item'] = $this->__itemRepository->getItemById($this->__model, $id);
        $result['cities'] = $this->__contentRepository
                    ->getContents($this->__city_model, ['City', 'publish'], 300, 'all');

        return view('auth.addresses.create_and_edit', compact('result'));
    }

    public function edit($locale, $id)
    {
        $result['item'] = $this->__itemRepository->getItemById($this->__model, $id);

        $result['cities'] = $this->__contentRepository
            ->getContents($this->__city_model, ['City', 'publish'], 300, 'all');

        return view('auth.addresses.create_and_edit', compact('result'));
    }

    public function update($locale, AddressRequest $request, $id)
    {
        $item = $this->__itemRepository->getItemById($this->__model, $id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->__path);
        }

        $this->__itemRepository->updateItem($this->__model, $id, $data);

        toastr()->success(__('titles.UpdatedMessage'));

        return redirect()->route('website.auth.addresses.index', ['locale' => app()->getLocale()]);
    }

    public function destroy($id)
    {
        $result = [];
        $item = $this->__itemRepository->getItemById($this->__model, $id);

        toastr()->success(__('titles.DeletedMessage'));

        return redirect()->route('website.auth.addresses.index', ['locale' => app()->getLocale()]);
    }
}
