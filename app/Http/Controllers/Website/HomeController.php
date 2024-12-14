<?php

namespace App\Http\Controllers\Website;

use App\Models\ContactUs;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SubscribeRequest;
use App\Interfaces\ContentRepositoryInterface;
use App\Models\Feedback;

class HomeController extends Controller
{
    private ContentRepositoryInterface $contentRepository;
    private $featureScope = 'Feature';
    private $clientScope = 'Client';
    private $faqScope = 'Question';
    private $contentModel = '\App\Models\Content';
    private $settingModel = '\App\Models\Setting';
    private $pageModel = '\App\Models\Page';
    private $productModel = '\App\Models\Product';
    private $bannerModel = '\App\Models\Banner';
    private $articleModel = '\App\Models\Article\Article';
    private $testimonialModel = '\App\Models\Testimonial';

    public function __construct(
        ContentRepositoryInterface $contentRepository
    ) {
        $this->contentRepository = $contentRepository;
    }
    public function index(Request $request)
    {
        $result = [];
        $result['articles'] = $this->contentRepository->getContents($this->articleModel, ['publish'], 3, 'list');
        $result['sliders'] = $this->contentRepository->getContents($this->bannerModel, ['publish', 'slider'], 8, 'list');
        $result['two_banners'] = $this->contentRepository->getContents($this->bannerModel, ['publish', 'two'], 2, 'list');
        $result['three_banners'] = $this->contentRepository->getContents($this->bannerModel, ['publish', 'three'], 3, 'list');
        $result['full_banners'] = $this->contentRepository->getContents($this->bannerModel, ['publish', 'full'], 1, 'list');
        $result['features'] = $this->contentRepository->getContents($this->contentModel, ['publish', $this->featureScope], 5, 'list');
        $result['clients'] = $this->contentRepository->getContents($this->contentModel, [$this->clientScope], 8, 'list');
        $result['faqs'] = $this->contentRepository->getContents($this->contentModel, ['publish', $this->faqScope], 4, 'list');
        $result['testimonials'] = $this->contentRepository->getContents($this->testimonialModel, ['publish'], 4, 'list');
        $result['brands'] = $this->contentRepository
            ->getContents($this->productModel . '\Brand', ['publish'], 10, 'list');

        $result['newArrivals'] = $this->contentRepository
            ->getContents($this->productModel . '\Product', ['publish', 'New'], 15, 'list');

        $result['specialOffers'] = $this->contentRepository
            ->getContents($this->productModel . '\Product', ['publish', 'SpecialOffers'], 5, 'list');

        $result['bestSellers'] = $this->contentRepository
            ->getContents($this->productModel . '\Product', ['publish', 'BestSeller'], 8, 'list');

        $result['boldProducts'] = $this->contentRepository
            ->getContents($this->productModel . '\Product', ['publish', 'Bold'], 8, 'list');

        $result['categories'] = $this->contentRepository
            ->getContents($this->productModel . '\Category', ['publish', 'category'], 6, 'list');

        return view('website.home.index', compact('result'));
    }

    public function showAboutUs(Request $request)
    {
        $result = [];
        $result['features'] = $this->contentRepository
            ->getContents($this->contentModel, ['publish', $this->featureScope], 6, 'list');

        $result['page']['vision'] = $this->contentRepository->getSingleContent($this->pageModel, ['vision']);
        $result['page']['mission'] = $this->contentRepository->getSingleContent($this->pageModel, ['mission']);
        $result['page']['about'] = $this->contentRepository->getSingleContent($this->pageModel, ['about']);

        $result['partners'] = $this->contentRepository
            ->getContents($this->contentModel, ['publish', $this->clientScope], 6, 'list');

        return view('website.pages.about', compact('result'));
    }

    public function showClients(Request $request)
    {
        $result = [];
        $result['items'] = $this->contentRepository->getContents($this->contentModel, [$this->clientScope]);

        return view('website.pages.clients', compact('result'));
    }

    public function showServices(Request $request)
    {
        $result = [];
        $result['items'] = $this->contentRepository->getContents($this->contentModel, ['publish', $this->featureScope]);

        return view('website.pages.services', compact('result'));
    }

    public function showFaqs(Request $request)
    {
        $result = [];
        $result['items'] = $this->contentRepository->getContents($this->contentModel, ['publish', $this->faqScope]);

        return view('website.pages.faqs', compact('result'));
    }
    //
    public function showBrands(Request $request)
    {
        $result = [];
        $result['items'] = $this->contentRepository
            ->getContents($this->productModel . '\Brand', ['publish'], 30, 'paginate');

        return view('website.pages.brands', compact('result'));
    }

    public function showcategories(Request $request)
    {
        $result = [];
        $result['items'] = $this->contentRepository
            ->getContents($this->productModel . '\Category', ['publish', 'Category'], 30, 'paginate');

        return view('website.pages.categories', compact('result'));
    }

    public function showContactUs(Request $request)
    {
        $result = [];
        return view('website.pages.contact', compact('result'));
    }

    public function showTerms(Request $request)
    {
        $result = [];
        return view('website.pages.terms', compact('result'));
    }

    public function showReturn(Request $request)
    {
        $result = [];
        return view('website.pages.return', compact('result'));
    }

    public function showPrivacy(Request $request)
    {
        $result = [];
        return view('website.pages.privacy', compact('result'));
    }





    public function contactUs(ContactRequest $request, $locale)
    {
        Feedback::create($request->all());
        $request->session()->flash('success', __('titles.ContactUsMessage'));

        return redirect()->back();
    }

    public function subscribe(SubscribeRequest $request)
    {
        $data = $request->all();
        NewsLetter::create($data);
        $request->session()->flash('success', __('titles.SubscribeSuccessfully'));

        return redirect()->back();
    }
}
