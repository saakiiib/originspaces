<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ExpandableHouseSeeder extends Seeder
{
    /** Set to false to hide supplier/price/qty rows (they show as Tech Specs on the product page). */
    private bool $includeCommercialData = true;

    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'expandable-container-houses'],
            [
                'name' => 'Expandable Container Houses',
                'description' => 'Double-wing expandable modular houses that fold into a 20 ft container for transport.',
                'meta_title' => 'Expandable Container Houses',
                'status' => true,
                'sort_order' => (int) Category::max('sort_order') + 1,
            ]
        );

        $items = [
            [
                'slug' => 'hy260831-01',
                'model_code' => 'HY260831-01',
                'name' => '20 ft Expandable Container House (HAOYE)',
                'price' => 4950.00,
                'dimensions' => 'Expanded 5,900 × 6,300 mm; Folded 5,900 × 2,200 × 2,480 mm',
                'expanded' => '5,900 × 6,300 mm',
                'commercial' => [
                    ['Product ID', 'HY260831-01'],
                    ['Supplier', 'HENGSHUI HAOYE CO., LTD'],
                    ['Contract Qty', '2 sets'],
                    ['Contract Unit Price', 'USD 4,950.00'],
                    ['Contract Line Total', 'USD 9,900.00'],
                    ['Terms', 'FOB Tianjin'],
                    ['Source Basis', 'Contract HY260831 (signed). Product ID assigned for this list; no manufacturer SKU shown.'],
                ],
            ],
            [
                'slug' => 'zxh-20ft-01',
                'model_code' => 'ZXH-20FT-01',
                'name' => '20 ft Expandable Container House (ZXH)',
                'price' => 4980.00,
                'dimensions' => 'Expanded 5,900 × 6,340 × 2,480 mm; Folded 5,900 × 2,200 × 2,480 mm',
                'expanded' => '5,900 × 6,340 × 2,480 mm',
                'commercial' => [
                    ['Supplier', 'Hebei Zhongxinhe Integrated Housing Co., Ltd.'],
                    ['Quoted Qty', '2 sets'],
                    ['Factory Price / Set', 'USD 4,980.00'],
                    ['Factory Total', 'USD 9,960.00'],
                    ['Freight / Term', 'USD 5,250 - CIF Felixstowe'],
                    ['Total CIF', 'USD 15,210.00'],
                    ['Quote Notes', 'Tax excluded. Factory container loading and packaging included.'],
                    ['Source Basis', 'Separate quotation, not added to contract order quantity.'],
                ],
            ],
        ];

        foreach ($items as $it) {
            $product = Product::updateOrCreate(
                ['slug' => $it['slug']],
                [
                    'category_id' => $category->id,
                    'name' => $it['name'],
                    'model_code' => $it['model_code'],
                    'tagline' => '20 ft double-wing expandable modular house with 2 bedrooms, living room, kitchen and bathroom.',
                    'description' => '20 ft double-wing expandable modular house. Layout: 2 bedrooms, 1 living room, 1 kitchen and 1 bathroom. Expanded '.$it['dimensions'].'; internal 5,640 × 6,180 × 2,240 mm; stated net weight 3.0 tonnes. Specification describes a galvanized frame, 75 mm exterior EPS wall panels, 50 mm internal partitions, magnesium-based base floor with 2 mm PVC finish, 3 doors, 6 double-glazed sliding windows with screens, bathroom fittings, L-shaped kitchen cabinets, electrical wiring, and hot/cold water and drainage. Layout and appearance images are references.',
                    'dimensions' => $it['dimensions'],
                    'base_price' => $it['price'],
                    'hero_image' => null,
                    'show_3d' => false,
                    'is_featured' => false,
                    'status' => true,
                    'sort_order' => (int) Product::max('sort_order') + 1,
                    'meta_title' => $it['name'],
                    'meta_description' => '20 ft double-wing expandable modular house with 2 bedrooms, living room, kitchen and bathroom.',
                ]
            );

            $product->materials()->delete();
            foreach ([
                'Galvanized steel frame',
                '75 mm EPS exterior wall panels',
                '50 mm internal partition panels',
                'Magnesium-based base floor with 2 mm PVC finish',
                'Double-glazed sliding windows with screens',
            ] as $i => $name) {
                $product->materials()->create(['name' => $name, 'sort_order' => $i]);
            }

            $product->specs()->delete();
            foreach ([
                '2 bedrooms, 1 living room, 1 kitchen and 1 bathroom',
                '3 doors and 6 double-glazed sliding windows with screens',
                'Bathroom fittings and L-shaped kitchen cabinets included',
                'Electrical wiring, hot/cold water and drainage installed',
            ] as $i => $point) {
                $product->specs()->create(['point' => $point, 'sort_order' => $i]);
            }

            $rows = [
                ['Expanded Size', $it['expanded'], true],
                ['Folded Size', '5,900 × 2,200 × 2,480 mm', true],
                ['Internal Size', '5,640 × 6,180 × 2,240 mm', false],
                ['Net Weight', '3.0 tonnes', false],
                ['Exterior Wall', '75 mm EPS panel', false],
                ['Internal Partition', '50 mm panel', false],
                ['Floor', 'Magnesium base + 2 mm PVC', false],
            ];
            if ($this->includeCommercialData) {
                foreach ($it['commercial'] as [$label, $value]) {
                    $rows[] = [$label, $value, false];
                }
            }

            $product->techSpecs()->delete();
            foreach ($rows as $i => [$label, $value, $highlight]) {
                $product->techSpecs()->create([
                    'label' => $label,
                    'value' => $value,
                    'highlight' => $highlight,
                    'sort_order' => $i,
                ]);
            }
        }

        // Deactivate all old products and categories (status = 0), keep only the new ones active
        Product::whereNotIn('slug', array_column($items, 'slug'))->update(['status' => 0]);
        Category::where('id', '!=', $category->id)->update(['status' => 0]);
    }
}