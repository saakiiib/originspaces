<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\Product;
use App\Models\Category;
$products = Product::select('id','name','video_url','category_id')->get();
echo "PRODUCTS:\n";
foreach ($products as $p) {
    echo $p->id . ' | ' . $p->name . ' | video_url=' . ($p->video_url ?? 'NULL') . ' | cat=' . $p->category_id . "\n";
}
echo "\nCATEGORIES:\n";
$cats = Category::select('id','name','video_url')->get();
foreach ($cats as $c) {
    echo $c->id . ' | ' . $c->name . ' | video_url=' . ($c->video_url ?? 'NULL') . "\n";
}
