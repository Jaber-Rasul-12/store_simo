<?php 

namespace Store\Store\Updates\Seeders;

use Seeder;
use DB ;

class SeedBrandsTable extends Seeder
{
    public function run()
    {
        DB::table('store_store_brands')->insert([
            [
                'name' => 'Zara',
                'slug' => 'zara',
                'description' => 'ماركة أزياء إسبانية عالمية معروفة بأناقتها وعصرية تصاميمها',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'H&M',
                'slug' => 'h-m',
                'description' => 'ماركة سويدية تقدم أزياء عصرية بأسعار مناسبة للجميع',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mango',
                'slug' => 'mango',
                'description' => 'ماركة إسبانية تقدم أزياء نسائية أنيقة وعملية',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Shein',
                'slug' => 'shein',
                'description' => 'ماركة صينية تقدم موضة سريعة بأسعار اقتصادية وتنوع كبير',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Forever 21',
                'slug' => 'forever-21',
                'description' => 'ماركة أمريكية معروفة بأزياء الشباب العصرية والمشرقة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'description' => 'ماركة رياضية عالمية رائدة في ملابس وأحذية الرياضة',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'description' => 'ماركة رياضية ألمانية معروفة بجودتها العالية وتصاميمها المميزة',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Puma',
                'slug' => 'puma',
                'description' => 'ماركة رياضية ألمانية تجمع بين الرياضة والموضة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gucci',
                'slug' => 'gucci',
                'description' => 'علامة فاخرة إيطالية معروفة بأناقتها وتصاميمها الفاخرة',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Louis Vuitton',
                'slug' => 'louis-vuitton',
                'description' => 'علامة فاخرة فرنسية رائدة في عالم الأزياء والحقائب',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chanel',
                'slug' => 'chanel',
                'description' => 'علامة فاخرة فرنسية أيقونية في عالم الأزياء والعطور',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dior',
                'slug' => 'dior',
                'description' => 'علامة فاخرة فرنسية معروفة بأناقتها وتصاميمها الراقية',
                'status' => true,
                'is_featured' => true,
                'is_top' => true,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Prada',
                'slug' => 'prada',
                'description' => 'علامة فاخرة إيطالية تجمع بين الحداثة والأناقة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Versace',
                'slug' => 'versace',
                'description' => 'علامة فاخرة إيطالية معروفة بتصاميمها الجريئة والملونة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Michael Kors',
                'slug' => 'michael-kors',
                'description' => 'ماركة أمريكية تقدم أزياء أنيقة وعصرية بأسعار معقولة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Calvin Klein',
                'slug' => 'calvin-klein',
                'description' => 'ماركة أمريكية معروفة بتصاميمها البسيطة والحديثة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tommy Hilfiger',
                'slug' => 'tommy-hilfiger',
                'description' => 'ماركة أمريكية كلاسيكية معروفة بأسلوبها الرياضي الأنيق',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ralph Lauren',
                'slug' => 'ralph-lauren',
                'description' => 'ماركة أمريكية تمثل الأناقة الكلاسيكية والفخامة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Uniqlo',
                'slug' => 'uniqlo',
                'description' => 'ماركة يابانية تقدم ملابس أساسية عالية الجودة وبسيطة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Marks & Spencer',
                'slug' => 'marks-spencer',
                'description' => 'ماركة بريطانية معروفة بجودة ملابسها وأناقتها العملية',
                'status' => true,
                'is_featured' => false,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Next',
                'slug' => 'next',
                'description' => 'ماركة بريطانية تقدم أزياء عائلية بأناقة وعملية',
                'status' => true,
                'is_featured' => false,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ASOS',
                'slug' => 'asos',
                'description' => 'منصة أزياء إنجليزية تقدم مجموعة واسعة من الماركات والتصاميم',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Boohoo',
                'slug' => 'boohoo',
                'description' => 'ماركة بريطانية تقدم موضة سريعة بأسعار منخفضة للشباب',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Missguided',
                'slug' => 'missguided',
                'description' => 'ماركة بريطانية موجهة للشابات تقدم أزياء عصرية وجريئة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PrettyLittleThing',
                'slug' => 'prettylittlething',
                'description' => 'ماركة بريطانية تقدم أزياء نسائية عصرية وجذابة',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'River Island',
                'slug' => 'river-island',
                'description' => 'ماركة بريطانية تقدم أزياء عصرية للشباب',
                'status' => true,
                'is_featured' => false,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Topshop',
                'slug' => 'topshop',
                'description' => 'ماركة بريطانية كانت رائدة في أزياء الشباب العصرية',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Urban Outfitters',
                'slug' => 'urban-outfitters',
                'description' => 'ماركة أمريكية تقدم أزياء بديلة وعصرية للشباب',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Anthropologie',
                'slug' => 'anthropologie',
                'description' => 'ماركة أمريكية تقدم أزياء وأثاث على طراز بوهيمي أنيق',
                'status' => true,
                'is_featured' => false,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Free People',
                'slug' => 'free-people',
                'description' => 'ماركة أمريكية بوهيمية تقدم أزياء حرة وروحانية',
                'status' => true,
                'is_featured' => true,
                'is_top' => false,
                'is_popular' => true,
                'is_trending' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}   
