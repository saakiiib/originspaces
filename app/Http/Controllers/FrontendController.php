<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanyDetails;
use App\Models\Contact;
use App\Models\NewsletterSubscriber;
use App\Models\Offer;
use App\Models\OfferItem;
use App\Models\PageSeo;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use OpenGraph;
use SEOMeta;
use Twitter;

class FrontendController extends Controller
{
    public function index()
    {
        $this->seo();

        $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();

        // Featured products
        $featuredProducts = Product::with(['brand', 'category'])
            ->where('status', 1)
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $categories = Category::where('status', 1)->whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();
        $brands = Brand::where('status', 1)->take(8)->get();

        // Products by attribute
        $hotProducts = Product::with(['brand', 'category'])
            ->where('status', 1)->where('is_hot', 1)
            ->orderBy('sort_order')->take(8)->get();

        $bestSellingProducts = Product::with(['brand', 'category'])
            ->where('status', 1)->where('is_most_selling', 1)
            ->orderBy('sort_order')->take(8)->get();

        $newArrivalProducts = Product::with(['brand', 'category'])
            ->where('status', 1)->where('is_new_arrival', 1)
            ->orderBy('sort_order')->take(8)->get();

        // Active offers with their products (for homepage countdown section)
        $activeOffers = Offer::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->with(['offerItems.product' => function ($q) {
                $q->where('status', 1)->with(['brand', 'category']);
            }])
            ->get();

        return spa('frontend.index', compact(
            'sliders', 'testimonials',
            'featuredProducts', 'categories', 'brands',
            'hotProducts', 'bestSellingProducts', 'newArrivalProducts',
            'activeOffers'
        ));
    }

    public function shop(Request $request)
    {
        $this->seo('shop');

        $query = Product::with(['brand', 'category'])
            ->where('status', 1);

        // Multiple categories
        if ($request->filled('category')) {
            $catSlugs = is_array($request->category) ? $request->category : [$request->category];
            $catIds = [];
            foreach ($catSlugs as $slug) {
                $cat = Category::where('slug', $slug)->first();
                if ($cat) {
                    $catIds[] = $cat->id;
                    $catIds = array_merge($catIds, $cat->children->pluck('id')->toArray());
                }
            }
            if (! empty($catIds)) {
                $query->whereIn('category_id', array_unique($catIds));
            }
        }

        // Multiple brands
        if ($request->filled('brand')) {
            $brandSlugs = is_array($request->brand) ? $request->brand : [$request->brand];
            $brandIds = Brand::whereIn('slug', $brandSlugs)->pluck('id')->toArray();
            if (! empty($brandIds)) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $q->where('offer_price', '>=', $request->min_price)
                    ->orWhere(function ($q2) use ($request) {
                        $q2->whereNull('offer_price')->where('regular_price', '>=', $request->min_price);
                    });
            });
        }
        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $q->where('offer_price', '<=', $request->max_price)
                    ->orWhere(function ($q2) use ($request) {
                        $q2->whereNull('offer_price')->where('regular_price', '<=', $request->max_price);
                    });
            });
        }

        if ($request->filled('offer')) {
            $productIds = OfferItem::where('offer_id', $request->offer)->pluck('product_id');
            $query->whereIn('id', $productIds);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%");
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(offer_price, regular_price) asc');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(offer_price, regular_price) desc');
                break;
            case 'oldest':
                $query->orderBy('id', 'asc');
                break;
            default:
                $query->orderByDesc('id');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', 1)->whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();
        $brands = Brand::where('status', 1)->get();
        $offers = Offer::where('status', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        // Price range for filter
        $priceRange = Product::where('status', 1)
            ->selectRaw('MIN(COALESCE(offer_price, regular_price)) as min_price, MAX(COALESCE(offer_price, regular_price)) as max_price')
            ->first();

        return spa('frontend.shop', compact('products', 'categories', 'brands', 'offers', 'priceRange'));
    }

    public function productShow($slug)
    {
        $this->seo('product');

        $product = Product::with(['brand', 'category', 'unit', 'images'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Related products from same category
        $related = Product::with(['brand'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return spa('frontend.product-show', compact('product', 'related'));
    }

    public function storeReview(Request $request, $id)
    {
        if (! auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Please login to submit a review.'], 401);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'title' => $request->title,
            'review' => $request->review,
            'status' => 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Review submitted! It will be visible after approval.']);
    }

    public function about()
    {
        $this->seo('about');
        $company = CompanyDetails::first();

        return spa('frontend.about', compact('company'));
    }

    public function contact()
    {
        $this->seo('contact');
        $company = CompanyDetails::first();

        $a = rand(1, 20);
        $b = rand(1, 20);
        $op = rand(0, 1) ? '+' : '-';
        $captchaAnswer = $op === '+' ? $a + $b : $a - $b;
        $captchaQuestion = "$a $op $b = ?";

        return spa('frontend.contact', compact('company', 'captchaQuestion', 'captchaAnswer'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->except('captcha'));

        return response()->json(['success' => true, 'message' => 'Message sent successfully.']);
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $request->email],
            ['status' => 1]
        );

        return response()->json(['success' => true, 'message' => 'Subscribed successfully! Check your inbox.']);
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->input('q', '');
        if (strlen($query) < 2) {
            return response()->json(['products' => [], 'categories' => []]);
        }

        $products = Product::with(['brand', 'category'])
            ->where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('code', 'like', "%{$query}%");
            })
            ->take(8)
            ->get()
            ->map(function ($p) {
                $price = $p->offer_price ?? $p->regular_price;

                return [
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'image' => $p->image ? asset(ltrim($p->image, '/')) : asset('placeholder.webp'),
                    'brand' => $p->brand?->name ?? '',
                    'price' => number_format($price, 0),
                    'old_price' => $p->offer_price ? number_format($p->regular_price, 0) : null,
                    'show_price' => $p->show_price ?? 1,
                ];
            });

        $categories = Category::where('status', 1)
            ->where('name', 'like', "%{$query}%")
            ->take(4)
            ->get()
            ->map(function ($c) {
                return ['name' => $c->name, 'slug' => $c->slug];
            });

        return response()->json(['products' => $products, 'categories' => $categories]);
    }

    public function faq()
    {
        $this->seo('faq');

        return spa('frontend.static.faq');
    }

    public function shipping()
    {
        $this->seo('shipping');
        $company = CompanyDetails::first();

        return spa('frontend.static.shipping', compact('company'));
    }

    public function returns()
    {
        $this->seo('returns');
        $company = CompanyDetails::first();

        return spa('frontend.static.returns', compact('company'));
    }

    public function privacy()
    {
        $this->seo('privacy');
        $company = CompanyDetails::first();

        return spa('frontend.static.privacy', compact('company'));
    }

    public function terms()
    {
        $this->seo('terms');
        $company = CompanyDetails::first();

        return spa('frontend.static.terms', compact('company'));
    }

    private function seo($pageKey = null, $title = null, $description = null, $keywords = null, $image = null)
    {
        $company = CompanyDetails::first();
        $pageSeo = $pageKey ? PageSeo::where('page_key', $pageKey)->first() : null;

        $title = $title ?: ($pageSeo?->meta_title ?: $company?->meta_title);
        $description = $description ?: ($pageSeo?->meta_description ?: $company?->meta_description);
        $keywords = $keywords ?: ($pageSeo?->meta_keywords ?: $company?->meta_keywords);
        $image = $image ?: ($pageSeo?->meta_image
            ? asset($pageSeo->meta_image)
            : ($company?->meta_image ? asset('uploads/company/'.$company->meta_image) : null));

        if ($title) {
            SEOMeta::setTitle($title);
            OpenGraph::setTitle($title);
            Twitter::setTitle($title);
        }
        if ($description) {
            SEOMeta::setDescription($description);
            OpenGraph::setDescription($description);
            Twitter::setDescription($description);
        }
        if ($keywords) {
            SEOMeta::setKeywords($keywords);
        }
        if ($image) {
            OpenGraph::addImage($image);
            Twitter::setImage($image);
        }
    }
}
