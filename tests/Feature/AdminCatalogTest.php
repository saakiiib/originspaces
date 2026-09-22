<?php

use App\Models\Category;
use App\Models\Download;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FloorZone;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\PageSeo;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function adminUser(): User
{
    return User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
        'user_type' => 1,
    ]);
}

test('category persists SEO and video fields', function () {
    $cat = Category::create([
        'name' => 'Expandable Homes', 'slug' => 'expandable-homes',
        'meta_title' => 'Expandable Homes UK', 'meta_description' => 'Desc',
        'meta_keywords' => 'a, b', 'meta_image' => '/uploads/category/x.webp',
        'video_url' => 'https://example.com/v.mp4',
    ]);

    expect($cat->meta_title)->toBe('Expandable Homes UK')
        ->and($cat->video_url)->toBe('https://example.com/v.mp4');
});

test('product creation keeps price optional and seeds tech specs', function () {
    $admin = adminUser();
    $cat = Category::create(['name' => 'Kitchen', 'slug' => 'kitchen']);

    $response = $this->actingAs($admin)->post(route('products.store'), [
        'name' => 'The Aster 38', 'model_code' => 'HS-EXP-38/AST', 'category_id' => $cat->id,
    ]);

    $response->assertOk()->assertJson(['message' => 'Product created successfully']);

    $product = Product::where('model_code', 'HS-EXP-38/AST')->firstOrFail();
    expect($product->base_price)->toBeNull()
        ->and($product->techSpecs)->toHaveCount(4)
        ->and($product->slug)->toContain('aster');

    // SEO array shape for frontend SEOMeta/OpenGraph
    $seo = $product->seoArray();
    expect($seo)->toHaveKeys(['title', 'description', 'keywords', 'image']);
});

test('product rejects duplicate model code and invalid option group', function () {
    $admin = adminUser();
    Product::create(['name' => 'A', 'slug' => 'a', 'model_code' => 'DUP-1']);

    $this->actingAs($admin)->post(route('products.store'), [
        'name' => 'B', 'model_code' => 'DUP-1',
    ])->assertStatus(302)->assertInvalid('model_code');

    $product = Product::where('model_code', 'DUP-1')->first();
    $this->actingAs($admin)->post(route('product-options.store', $product->id), [
        'group' => 'invalid', 'name' => 'X',
    ])->assertStatus(302)->assertInvalid('group');
});

test('product option price empty means included, finish keeps swatch', function () {
    $product = Product::create(['name' => 'P', 'slug' => 'p', 'model_code' => 'M-1']);
    $opt = ProductOption::create([
        'product_id' => $product->id, 'group' => 'finish',
        'name' => 'Smoked Oak', 'price_delta' => null, 'swatch_color' => '#5A4636',
    ]);

    expect($opt->price_delta)->toBeNull()->and($opt->swatch_color)->toBe('#5A4636');

    // video fallback: product empty -> category video
    $cat = Category::create(['name' => 'C', 'slug' => 'c', 'video_url' => 'https://example.com/cat.mp4']);
    $product->update(['category_id' => $cat->id, 'video_url' => null]);
    expect($product->fresh()->effectiveVideoUrl())->toBe('https://example.com/cat.mp4');
});

test('supporting modules persist with relations', function () {
    $faqCat = FaqCategory::create(['name' => 'Lead Times', 'slug' => 'lead-times']);
    $faq = Faq::create(['faq_category_id' => $faqCat->id, 'question' => 'Q?', 'answer' => 'A.']);
    $galCat = GalleryCategory::create(['name' => 'Exterior', 'slug' => 'exterior']);
    $gal = Gallery::create(['gallery_category_id' => $galCat->id, 'image' => '/uploads/gallery/x.webp']);
    $zone = FloorZone::create(['name' => 'Master Suite', 'dims' => '3.2 m × 3.0 m', 'status' => true]);
    $product = Product::create(['name' => 'P2', 'slug' => 'p2', 'model_code' => 'M-2']);
    $dl = Download::create(['title' => 'Lookbook', 'file' => '/uploads/downloads/x.pdf', 'format' => 'PDF Spec', 'product_id' => $product->id]);
    $enq = Enquiry::create(['name' => 'Jane', 'email' => 'jane@example.com', 'product_id' => $product->id, 'source_page' => 'details']);

    expect($faq->category->id)->toBe($faqCat->id)
        ->and($gal->category->id)->toBe($galCat->id)
        ->and($dl->product->id)->toBe($product->id)
        ->and($enq->product->id)->toBe($product->id)
        ->and($zone->status)->toBeTrue();
});

test('page seo seeds new static keys', function () {
    $admin = adminUser();
    $this->actingAs($admin)->get(route('page-seo.index'))->assertOk();

    $keys = PageSeo::pluck('page_key')->all();
    foreach (['home', 'about', 'collections', 'custom-build', 'gallery', 'downloads', 'contact', 'privacy', 'terms'] as $key) {
        expect($keys)->toContain($key);
    }
});

test('admin product and enquiry pages render', function () {
    $admin = adminUser();
    $product = Product::create(['name' => 'P3', 'slug' => 'p3', 'model_code' => 'M-3']);

    $this->actingAs($admin)->get(route('products.index'))->assertOk();
    $this->actingAs($admin)->get(route('products.manage', $product->id))->assertOk();
    $this->actingAs($admin)->get(route('enquiries.index'))->assertOk();
    $this->actingAs($admin)->get(route('faqs.index'))->assertOk();
    $this->actingAs($admin)->get(route('galleries.index'))->assertOk();
    $this->actingAs($admin)->get(route('downloads.index'))->assertOk();
});
