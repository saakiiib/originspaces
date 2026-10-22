<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    public function list($productId)
    {
        return response()->json(
            ProductImage::where('product_id', $productId)->orderBy('sort_order')->get()
                ->map(function ($i) {
                    $data = [
                        ...$i->toArray(),
                        'preview' => $i->image ? url($i->image) : null,
                        'video_preview' => $i->video_file ? url($i->video_file) : null,
                        'video_url' => $i->video_url,
                    ];
                    return $data;
                })
        );
    }

    public function store(Request $request, $productId)
    {
        $hasImage = $request->hasFile('image') && $request->file('image')->isValid();
        $hasVideoFile = $request->hasFile('video_file') && $request->file('video_file')->isValid();
        $videoUrl = $request->input('video_url', null);

        if (! $hasImage && ! $hasVideoFile && empty($videoUrl)) {
            return response()->json(['message' => 'Provide image or video'], 422);
        }

        $data = [
            'product_id' => $productId,
            'caption' => $request->caption,
            'sort_order' => (int) (ProductImage::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ];

        if ($hasImage) {
            $path = public_path('uploads/products/gallery/');
            if (! file_exists($path)) mkdir($path, 0755, true);
            $name = mt_rand(10000000, 99999999).'.webp';
            Image::make($request->file('image'))->resize(1600, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->encode('webp', 75)->save($path.$name);
            $data['image'] = '/uploads/products/gallery/'.$name;
        }

        if ($hasVideoFile) {
            $vpath = public_path('uploads/products/videos/');
            if (! file_exists($vpath)) mkdir($vpath, 0755, true);
            $vname = mt_rand(10000000, 99999999).'.mp4';
            $request->file('video_file')->move($vpath, $vname);
            $data['video_file'] = '/uploads/products/videos/'.$vname;
        }

        if ($videoUrl) {
            $data['video_url'] = $videoUrl;
        }

        $img = ProductImage::create($data);
        return response()->json(['message' => 'Added', 'data' => $img]);
    }

    public function update(Request $request, $id)
    {
        $img = ProductImage::findOrFail($id);
        $img->update($request->only(['caption', 'video_url']));
        return response()->json(['message' => 'Updated']);
    }

    public function destroy($id)
    {
        $img = ProductImage::findOrFail($id);
        if ($img->image && file_exists(public_path($img->image))) @unlink(public_path($img->image));
        if ($img->video_file && file_exists(public_path($img->video_file))) @unlink(public_path($img->video_file));
        $img->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
