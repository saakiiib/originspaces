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
                'name' => '20 ft Luxury Expandable Container House (ZXH)',
                'price' => 4980.00,
                'dimensions' => 'Expanded 6,420 × 5,900 × 2,450 mm; Folded 5,900 × 2,250 × 2,450 mm',
                'lead_time' => '15 days',
                'warranty' => '1 Year',
                'tagline' => 'Luxury 20 ft double-wing expandable container house for house, office and commercial use.',
                'description' => '20 ft luxury double-wing expandable container house for house and office use. Expanded external size 6,420 × 5,900 × 2,450 mm, expanded inner size 6,260 × 5,740 × 2,250 mm, folded size 5,900 × 2,250 × 2,450 mm, covering 38 m². Fireproof, waterproof, earthquake resistant and pressure resistant, with wind resistance level 12, earthquake resistance level 8 and a 30-year lifespan. Loads 2 sets per 40HQ container. Standard, thickened or customizable wall thickness. 1 year warranty with online technical support. The ZXH quotation lists a slightly different expanded size (5,900 × 6,340 × 2,480 mm); confirm the final size with the supplier.',
                'materials' => ['Galvanized steel frame', '75 mm EPS exterior wall panels', '50 mm internal partition panels', 'Magnesium-based base floor with 2 mm PVC finish', 'Double-glazed sliding windows with screens'],
                'specs' => [
                    'Features: fireproof, waterproof, earthquake resistant, pressure resistant',
                    'Suitable for house, office, shop, hotel, villa, dormitory, guard house and more',
                    'Wind resistance level 12, earthquake resistance level 8',
                    'Loads 2 sets per 40HQ container',
                    'Customization: minor, drawing-based, sample-based and full',
                ],
                'tech' => [
                    ['Expanded External Size', '6,420 × 5,900 × 2,450 mm', true],
                    ['Folded Size', '5,900 × 2,250 × 2,450 mm', true],
                    ['Expanded Inner Size', '6,260 × 5,740 × 2,250 mm', false],
                    ['Covered Area', '38 m²', false],
                    ['Loading', '2 sets / 40HQ', false],
                    ['Wind Resistance', 'Level 12', false],
                    ['Earthquake Resistance', 'Level 8', false],
                    ['Waterproof Performance', 'Level 1', false],
                    ['Lifespan', '30 years', false],
                    ['Thickness', 'Standard, Thicken, Customizable', false],
                    ['Brand', 'TDHH', false],
                    ['Place of Origin', 'Hebei, China', false],
                    ['Quoted Expanded Size (ZXH quote)', '5,900 × 6,340 × 2,480 mm', false],
                ],
                'commercial' => [
                    ['Supplier', 'Hebei Zhongxinhe Integrated Housing Co., Ltd.'],
                    ['Quoted Qty', '2 sets'],
                    ['Factory Price / Set', 'USD 4,980.00'],
                    ['Factory Total', 'USD 9,960.00'],
                    ['Freight / Term', 'USD 5,250 - CIF Felixstowe'],
                    ['Total CIF', 'USD 15,210.00'],
                    ['Quote Notes', 'Tax excluded. Factory container loading and packaging included.'],
                    ['Lead Time (listing)', '15 days for 1-200 sets; negotiable above 200'],
                    ['Source Basis', 'Separate quotation, not added to contract order quantity. Listing details from Alibaba page (supplier not named on page).'],
                ],
            ],
            [
                'slug' => 'rucheng-20ft-01',
                'model_code' => 'RCG-20FT-01',
                'name' => '20 ft Double Wing Expandable Container House (Rucheng)',
                'price' => null,
                'dimensions' => 'Expanded 6,420 × 5,900 × 2,450 mm; Folded 5,900 × 2,250 × 2,450 mm',
                'lead_time' => '30 days',
                'warranty' => '1 Year',
                'tagline' => 'Double-wing 20 ft expandable container house for construction camps, temporary offices and hurricane-resistant use.',
                'description' => '20 ft double-wing expandable container house suited to construction site camps, temporary offices and hurricane-resistant prefab use; the listing states compliance with EU standards. Expanded external size 6,420 × 5,900 × 2,450 mm, expanded inner size 6,260 × 5,740 × 2,250 mm, folded size 5,900 × 2,250 × 2,450 mm, covering 38 m². Fireproof, waterproof, earthquake resistant and pressure resistant, with wind resistance level 12, earthquake resistance level 8 and a 30-year lifespan. Loads 2 sets per 40HQ container. Standard, thickened or customizable wall thickness. 1 year warranty with online technical support. Project solutions include 3D model design and graphic design.',
                'materials' => ['Expandable container structure', 'Standard, thickened or customizable wall thickness'],
                'specs' => [
                    'Features: fireproof, waterproof, earthquake resistant, pressure resistant',
                    'Suitable for house, office, shop, hotel, villa, dormitory, guard house and more',
                    'Wind resistance level 12, earthquake resistance level 8',
                    'Loads 2 sets per 40HQ container',
                    'Customization: minor, drawing-based, sample-based and full',
                ],
                'tech' => [
                    ['Expanded External Size', '6,420 × 5,900 × 2,450 mm', true],
                    ['Folded Size', '5,900 × 2,250 × 2,450 mm', true],
                    ['Expanded Inner Size', '6,260 × 5,740 × 2,250 mm', false],
                    ['Covered Area', '38 m²', false],
                    ['Loading', '2 sets / 40HQ', false],
                    ['Wind Resistance', 'Level 12', false],
                    ['Earthquake Resistance', 'Level 8', false],
                    ['Waterproof Performance', 'Level 1', false],
                    ['Lifespan', '30 years', false],
                    ['Thickness', 'Standard, Thicken, Customizable', false],
                    ['Brand', 'TDHH', false],
                    ['Place of Origin', 'Hebei, China', false],
                    ['Lead Time', '30 days (1-200 sets)', false],
                ],
                'commercial' => [
                    ['Supplier', 'Rucheng Construction Group Co., Ltd'],
                    ['Listed Price 1-9 sets (Alibaba)', 'BDT 862,109.53 per set'],
                    ['Listed Price 10+ sets (Alibaba)', 'BDT 738,933.43 per set'],
                    ['Source Basis', 'Listed in sheet as 20ft expandable houses with no price. Details from Alibaba listing (supplier not named on page; brand TDHH). Product ID assigned for this list.'],
                ],
            ],
            [
                'slug' => 'jiacheng-modular-house-01',
                'model_code' => 'JC-MOD-01',
                'name' => 'Double Wing Modular Container House (20 ft / 40 ft)',
                'price' => null,
                'dimensions' => '20 ft (6.10 m) / 40 ft (12.19 m) / custom size; packed 5,800 × 2,200 × 2,520 mm',
                'lead_time' => '15 days',
                'warranty' => '5 Years',
                'tagline' => 'Fast-assembly double-wing modular container house with a 1-4 bedroom multi-room layout.',
                'description' => 'Fast-assembly double-wing modular container house with a 1-4 bedroom multi-room layout and modern design. Steel frame base for structural stability, double-wing expansion for flexible use of space, and rock wool insulation for thermal and acoustic comfort. Available in 20 ft (6.10 m), 40 ft (12.19 m) and custom sizes, with container, EPS, sandwich panel or steel material options. Suitable for house use, shops, restaurants, hotels, offices, carports, schools, villas and more. 5 year warranty with online technical support. Supplier accepts minor, drawing-based, sample-based and full customization; thickness and material can be customized from a minimum order of 1 set. Graphic design and 3D model design supported.',
                'materials' => ['Steel frame base', 'Rock wool insulation', 'Container / EPS / sandwich panel / steel options'],
                'specs' => [
                    '1-4 bedroom multi-room layout',
                    'Double-wing expandable design for flexible space use',
                    'Rock wool insulation for thermal and acoustic comfort',
                    'Sizes: 20 ft (6.10 m), 40 ft (12.19 m) or custom',
                    'Customizable thickness and material (minimum order 1 set)',
                    'Supplier customization: minor, drawing-based, sample-based and full',
                ],
                'tech' => [
                    ['Size Options', '20 ft (6.10 m) / 40 ft (12.19 m) / Custom', true],
                    ['Layout', '1-4 bedrooms, multi-room', true],
                    ['Packed Size (single package)', '5,800 × 2,200 × 2,520 mm', false],
                    ['Gross Weight (single)', '3,500 kg', false],
                    ['Material Options', 'Container, EPS, Sandwich Panel, Steel', false],
                    ['Thickness', 'Standard, Thicken', false],
                    ['Warranty', '5 years', false],
                    ['Lead Time', '15 days (1-100 sets)', false],
                    ['Minimum Order', '1 set', false],
                    ['Brand', 'JIA CHENG', false],
                    ['Place of Origin', 'Hebei, China', false],
                ],
                'commercial' => [
                    ['Supplier', 'Hebei Jiacheng Integrated Housing Co., Ltd. (Hengshui, CN, custom manufacturer, 4 yrs)'],
                    ['Store Rating', '4.7/5 (51 ratings)'],
                    ['Response Time', '2 hours or less'],
                    ['On-time Dispatch Rate', '100% or more'],
                    ['Reorder Rate', '40%'],
                    ['Listed Price (Alibaba)', 'BDT 431,116.35 - 615,880.50 per set'],
                    ['Sheet Qty', '2'],
                    ['Source Basis', 'Listed as Modular house in product sheet; details from Alibaba listing 1601968318500. Product ID assigned for this list.'],
                ],
            ],
        ];

        $defTagline = '20 ft double-wing expandable modular house with 2 bedrooms, living room, kitchen and bathroom.';
        $defMaterials = [
            'Galvanized steel frame',
            '75 mm EPS exterior wall panels',
            '50 mm internal partition panels',
            'Magnesium-based base floor with 2 mm PVC finish',
            'Double-glazed sliding windows with screens',
        ];
        $defSpecs = [
            '2 bedrooms, 1 living room, 1 kitchen and 1 bathroom',
            '3 doors and 6 double-glazed sliding windows with screens',
            'Bathroom fittings and L-shaped kitchen cabinets included',
            'Electrical wiring, hot/cold water and drainage installed',
        ];

        foreach ($items as $it) {
            $product = Product::updateOrCreate(
                ['slug' => $it['slug']],
                [
                    'category_id' => $category->id,
                    'name' => $it['name'],
                    'model_code' => $it['model_code'],
                    'tagline' => $it['tagline'] ?? $defTagline,
                    'description' => $it['description'] ?? ('20 ft double-wing expandable modular house. Layout: 2 bedrooms, 1 living room, 1 kitchen and 1 bathroom. Expanded '.$it['dimensions'].'; internal 5,640 × 6,180 × 2,240 mm; stated net weight 3.0 tonnes. Specification describes a galvanized frame, 75 mm exterior EPS wall panels, 50 mm internal partitions, magnesium-based base floor with 2 mm PVC finish, 3 doors, 6 double-glazed sliding windows with screens, bathroom fittings, L-shaped kitchen cabinets, electrical wiring, and hot/cold water and drainage. Layout and appearance images are references.'),
                    'dimensions' => $it['dimensions'],
                    'base_price' => $it['price'],
                    'lead_time' => $it['lead_time'] ?? null,
                    'warranty' => $it['warranty'] ?? null,
                    'status' => true,
                    'sort_order' => (int) Product::max('sort_order') + 1,
                    'meta_title' => $it['name'],
                    'meta_description' => $it['tagline'] ?? $defTagline,
                ]
            );

            $product->materials()->delete();
            foreach (($it['materials'] ?? $defMaterials) as $i => $name) {
                $product->materials()->create(['name' => $name, 'sort_order' => $i]);
            }

            $product->specs()->delete();
            foreach (($it['specs'] ?? $defSpecs) as $i => $point) {
                $product->specs()->create(['point' => $point, 'sort_order' => $i]);
            }

            $rows = $it['tech'] ?? [
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