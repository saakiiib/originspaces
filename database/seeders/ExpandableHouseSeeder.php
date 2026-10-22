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
            // ===== 1. HAOYE (source: HY 20FT Standard PDF + signed contract) =====
            [
                'slug' => '20-ft-expandable-container-house-haoye-hy260831-01',
                'model_code' => 'HY260831-01',
                'name' => '20 ft Expandable Container House (HAOYE)',
                'sort_order' => 0,
                'price' => null,
                'dimensions' => 'Expanded 5,900 × 6,300 × 2,480 mm; Folded 5,900 × 2,200 × 2,480 mm',
                'lead_time' => null,
                'warranty' => null,
                'tagline' => '20 ft double-wing expandable modular house with 2 bedrooms, living room, kitchen and bathroom.',
                'description' => '20 ft standard configuration double-wing expandable container house. Layout: 2 bedrooms, 1 living room, 1 kitchen and 1 bathroom. Expanded size 5,900 × 6,300 × 2,480 mm, folded size 5,900 × 2,200 × 2,480 mm. 65 mm EPS fire resistance sandwich wall and roof panels, thermal break aluminium entrance door and windows, fireproof magnesium composite middle floor with 18 mm bamboo plywood side floors and PVC floor leather, L-shaped kitchen cabinet, and a dry and wet separation bathroom with shower, sliding door, toilet, washbasin, bathroom cabinet and mirror. Thermal insulation λ=0.048 W/m·K, sound insulation level ≥ 30 dB, fire resistance Class A, seismic performance Level 8. Layout and appearance images are references.',
                'materials' => [
                    'Galvanized steel frame',
                    '65 mm EPS fire resistance sandwich wall panels',
                    'EPS fire resistance sandwich roof panel with high end waterproof coating',
                    'Fireproof magnesium composite middle floor with 18 mm bamboo plywood side floors',
                    'PVC floor leather finish',
                    'Thermal break aluminium door and windows',
                ],
                'specs' => [
                    '2 bedrooms, 1 living room, 1 kitchen and 1 bathroom',
                    'Thermal break aluminium entrance door and windows',
                    'L-shaped kitchen cabinet, 3,660 × 550 × 900 mm',
                    'Dry and wet separation bathroom, 2,200 × 1,350 mm, with shower, sliding door, toilet, washbasin, cabinet and mirror',
                    'Incoming wiring 6 mm², A/C socket 4 mm², ordinary socket 2.5 mm², lighting 1.5 mm²',
                    '6 advanced LED ceiling lights; optional European, American and Australian standards',
                ],
                'tech' => [
                    ['Expanded Size', '5,900 × 6,300 × 2,480 mm', true],
                    ['Folded Size', '5,900 × 2,200 × 2,480 mm', true],
                    ['Layout', '2 bedrooms, 1 living room, 1 kitchen, 1 bathroom', false],
                    ['Thermal Insulation', 'λ = 0.048 W/m·K', false],
                    ['Sound Insulation', 'Level ≥ 30 dB', false],
                    ['Wind Resistance', '0.60 kN/m²', false],
                    ['Waterproof Performance', 'No leakage at precipitation of 16 mm/min', false],
                    ['Fire Resistance', 'Class A', false],
                    ['Seismic Performance', 'Level 8', false],
                    ['Exterior Wall Panel', '65 mm EPS fire resistance sandwich panel', false],
                    ['Interior Wall Panel', 'EPS fire resistance sandwich panel', false],
                    ['Roof', 'EPS fire resistance sandwich panel, high end waterproof coating', false],
                    ['Suspended Ceiling', '200 type contour buckle plate', false],
                    ['Entrance Door', 'Thermal break aluminium door', false],
                    ['Windows', 'Thermal break aluminium windows', false],
                    ['Electrical Wiring', 'Incoming 6 mm², A/C socket 4 mm², socket 2.5 mm², lighting 1.5 mm²', false],
                    ['Circuit Breaker', '3P64A switch ×1; 2P43A / 2P32A / 1P20 leakage protector, one each', false],
                    ['Lighting', 'Advanced LED ceiling light × 6', false],
                    ['Middle Floor', 'Fireproof magnesium composite flooring', false],
                    ['Side Floors', '18 mm bamboo plywood', false],
                    ['Floor Surface', 'PVC floor leather', false],
                    ['Kitchen Cabinet', 'L-shaped, 3,660 × 550 × 900 mm', false],
                    ['Bathroom', 'Dry wet separation, 2,200 × 1,350 mm', false],
                ],
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

            // ===== 2. ZXH (source: ZXH special offer quotation + product catalogue) =====
            [
                'slug' => '20-ft-luxury-expandable-container-house-zxh-zxh-20ft-01',
                'model_code' => 'ZXH-20FT-01',
                'name' => '20 ft Luxury Expandable Container House (ZXH)',
                'sort_order' => 1,
                'price' => 4980.00,
                'dimensions' => 'Expanded 5,900 × 6,340 × 2,480 mm; Folded 5,900 × 2,200 × 2,480 mm',
                'lead_time' => null,
                'warranty' => null,
                'tagline' => 'Luxury 20 ft double-wing expandable container house for house, office and commercial use.',
                'description' => '20 ft double-wing expandable container house with 2 bedrooms, 1 living room, 1 kitchen and 1 bathroom. Expanded size 5,900 × 6,340 × 2,480 mm, internal size 5,640 × 6,180 × 2,240 mm, folded size 5,900 × 2,200 × 2,480 mm, net weight 3.0 tonnes. Fully galvanized frame with electrostatic spray coating, 75 mm EPS exterior wall panels (wood grain, gray or white), 50 mm EPS internal partitions, 15 mm magnesium base floor with 2.0 mm PVC finish, double sliding broken-bridge aluminium entry door, 2 steel interior doors and 6 double-glazed aluminium sliding windows with screens. Bathroom with sliding glass door, shower, washbasin, mirror cabinet and toilet; L-shaped kitchen cabinets with stainless steel sink; GB standard wiring with completed water supply and drainage. Loads 2 sets per 40HQ container.',
                'materials' => [
                    'Fully galvanized steel frame, electrostatic spray coating',
                    '75 mm EPS exterior wall panels (flame retardant grade B)',
                    '50 mm EPS internal partition panels',
                    '15 mm magnesium base floor with 2.0 mm PVC finish',
                    'Aluminium alloy double-glazed sliding windows with screens',
                ],
                'specs' => [
                    '2 bedrooms, 1 living room, 1 kitchen and 1 bathroom',
                    '2 steel interior doors and 1 double sliding broken-bridge aluminium entry door',
                    '6 aluminium sliding windows (920 × 920 mm) with screens',
                    'L-shaped kitchen cabinets with stainless steel sink',
                    'Bathroom with sliding glass door, shower, washbasin, mirror cabinet, toilet and floor drain',
                    'GB standard wiring, hot/cold water and drainage installed',
                    'Loads 2 sets per 40HQ container',
                ],
                'tech' => [
                    ['Expanded Size', '5,900 × 6,340 × 2,480 mm', true],
                    ['Folded Size', '5,900 × 2,200 × 2,480 mm', true],
                    ['Internal Size', '5,640 × 6,180 × 2,240 mm', false],
                    ['Net Weight', '3.0 tonnes', false],
                    ['Seismic Resistance', 'Grade 8', false],
                    ['Wind Resistance', 'Quality class 10', false],
                    ['Roof Bearing', '60 kg/m²', false],
                    ['Ground Bearing', '200 kg/m²', false],
                    ['Exterior Wall', '75 mm EPS composite panel', false],
                    ['Internal Partition', '50 mm EPS composite panel', false],
                    ['Roof', '50 mm EPS color steel board', false],
                    ['Floor', '15 mm magnesium base + 2.0 mm PVC', false],
                    ['Entry Door', 'Double sliding broken-bridge aluminium, 1,890 × 2,230 mm', false],
                    ['Interior Doors', 'Single steel door × 2, 970 × 1,970 mm', false],
                    ['Windows', 'Aluminium sliding 920 × 920 mm × 6, double glass, with screens', false],
                    ['Wiring', 'Main 6 mm², A/C 4 mm², sockets 2.5 mm², lighting 1.5 mm²', false],
                    ['Loading', '2 sets / 40HQ', false],
                ],
                'commercial' => [
                    ['Supplier', 'Hebei Zhongxinhe Integrated Housing Co., Ltd.'],
                    ['Quoted Qty', '2 sets'],
                    ['Factory Price / Set', 'USD 4,980.00'],
                    ['Factory Total', 'USD 9,960.00'],
                    ['Freight / Term', 'USD 5,250 - CIF Felixstowe'],
                    ['Total CIF', 'USD 15,210.00'],
                    ['Quote Notes', 'Tax excluded. Factory container loading and packaging included.'],
                    ['Source Basis', 'ZXH special offer quotation and product catalogue. Separate quotation, not added to contract order quantity.'],
                ],
            ],

            // ===== 3. JIACHENG (unchanged) =====
            [
                'slug' => 'double-wing-modular-container-house-20-ft-40-ft-jc-mod-01',
                'model_code' => 'JC-MOD-01',
                'name' => 'Double Wing Modular Container House (20 ft / 40 ft)',
                'sort_order' => 2,
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

            // ===== 4. RUCHENG (unchanged) =====
            [
                'slug' => '20-ft-double-wing-expandable-container-house-rucheng-rcg-20ft-01',
                'model_code' => 'RCG-20FT-01',
                'name' => '20 ft Double Wing Expandable Container House (Rucheng)',
                'sort_order' => 3,
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

            // ===== 5. XINYU (new, source: Customized 20ft for Ireland PDF) =====
            [
                'slug' => '20-ft-expandable-container-house-xinyu-xy-20ft-01',
                'model_code' => 'XY-20FT-01',
                'name' => '20 ft Expandable Container House (Xinyu, UK Standard)',
                'sort_order' => 4,
                'price' => null,
                'dimensions' => 'Expanded 5,900 × 6,200 × 2,480 mm; Folded 5,900 × 2,200 × 2,480 mm',
                'lead_time' => null,
                'warranty' => null,
                'tagline' => '20 ft expandable house with 2 bedrooms, living room, kitchen and bathroom, configured to UK electrical standard.',
                'description' => '20 ft expandable container house with 2 bedrooms, 1 living room, 1 kitchen and 1 bathroom, customized for the UK/Ireland market. Expanded size 5,900 × 6,200 × 2,480 mm, folded size 5,900 × 2,200 × 2,480 mm, weight 3,200 kg. 100 mm sandwich wall and roof panels, 50 mm interior partitions, 40 mm floor sandwich plate over 18 mm cement fiber flooring with 4.0 mm SPC finish. UK standard electrical system with 16 mm² inlet line, 9 LED lights and leakage protectors; kitchen sockets at 1.2 m and all other sockets at 44 cm above the floor. Broken-bridge aluminium entrance door, 7 broken-bridge aluminium out-hung windows, dry and wet separate shower room with toilet and vanity mirror, instant water heater and warm light color.',
                'materials' => [
                    'Q235 galvanized steel frame with corner fittings',
                    '100 mm sandwich wall panels (EPS standard; rock wool or polyurethane optional)',
                    '50 mm sandwich interior partitions',
                    '18 mm cement fiber substrate floor with 4.0 mm SPC flooring',
                    'Broken-bridge aluminium door and out-hung windows',
                ],
                'specs' => [
                    '2 bedrooms, 1 living room, 1 kitchen and 1 bathroom',
                    'UK standard electrical system, 9 LED lights, leakage protectors',
                    'Dry and wet separate shower room with toilet and vanity mirror',
                    'Instant water heater included',
                    '1 broken-bridge aluminium entrance door and 7 out-hung windows',
                    'Warm color lighting',
                ],
                'tech' => [
                    ['Expanded Size', '5,900 × 6,200 × 2,480 mm', true],
                    ['Folded Size', '5,900 × 2,200 × 2,480 mm', true],
                    ['Weight', '3,200 kg', false],
                    ['Wind Resistance', 'Level 10', false],
                    ['Seismic Level', 'Level 8', false],
                    ['Thermal Insulation Range', '-35°C to 45°C', false],
                    ['Fire Resistance', '> 2 hours', false],
                    ['Sound Insulation', '≥ 30 dB', false],
                    ['Waterproof', 'No leakage at precipitation ≤ 20 mm/min', false],
                    ['Wall Panel', '100 mm sandwich panel, 0.25 mm color steel both sides', false],
                    ['Interior Partition', '50 mm sandwich panel', false],
                    ['Roof', '100 mm sandwich panel', false],
                    ['Floor', '40 mm sandwich plate + 18 mm cement fiber + 4.0 mm SPC', false],
                    ['Electrical', 'Inlet 16 mm², sockets 2.5 mm², lighting 1.5 mm²', false],
                    ['Circuit Protection', '2P63A ×1, 2P32A ×1, 2P16A ×1 leakage protectors', false],
                    ['Windows', 'Broken-bridge aluminium out-hung × 7', false],
                ],
                'commercial' => [
                    ['Supplier', 'XINYU INTEGRATED HOUSING CO., LTD'],
                    ['Source Basis', 'Customized 20 ft configuration for Ireland (no price shown in document).'],
                ],
            ],
        ];

        foreach ($items as $it) {
            $product = Product::updateOrCreate(
                ['model_code' => $it['model_code']],
                [
                    'slug' => $it['slug'],
                    'category_id' => $category->id,
                    'name' => $it['name'],
                    'tagline' => $it['tagline'],
                    'description' => $it['description'],
                    'dimensions' => $it['dimensions'],
                    'base_price' => $it['price'],
                    'lead_time' => $it['lead_time'],
                    'warranty' => $it['warranty'],
                    'status' => true,
                    'sort_order' => $it['sort_order'],
                    'meta_title' => $it['name'],
                    'meta_description' => $it['tagline'],
                ]
            );

            $product->materials()->delete();
            foreach ($it['materials'] as $i => $name) {
                $product->materials()->create(['name' => $name, 'sort_order' => $i]);
            }

            $product->specs()->delete();
            foreach ($it['specs'] as $i => $point) {
                $product->specs()->create(['point' => $point, 'sort_order' => $i]);
            }

            $rows = $it['tech'];
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