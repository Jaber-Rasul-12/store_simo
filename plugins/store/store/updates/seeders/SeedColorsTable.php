<?php 

namespace Store\Store\Updates\Seeders;

use Seeder;
use DB ;

class SeedColorsTable extends Seeder
{
    public function run()
    {
        DB::table('store_store_colors')->insert([
                      // ألوان أساسية
            [
                'name' => 'أسود',
                'code' => '#000000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أبيض',
                'code' => '#FFFFFF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'رمادي',
                'code' => '#808080',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'فضي',
                'code' => '#C0C0C0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان دافئة
            [
                'name' => 'أحمر',
                'code' => '#FF0000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'وردي',
                'code' => '#FFC0CB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'وردي فاتح',
                'code' => '#FFB6C1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'وردي غامق',
                'code' => '#DB7093',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'برتقالي',
                'code' => '#FFA500',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'برتقالي فاتح',
                'code' => '#FFB366',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'برتقالي محروق',
                'code' => '#CC5500',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ذهبي',
                'code' => '#FFD700',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان باردة
            [
                'name' => 'أزرق',
                'code' => '#0000FF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق فاتح',
                'code' => '#ADD8E6',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق سماوي',
                'code' => '#00BFFF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق غامق',
                'code' => '#00008B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نيلي',
                'code' => '#4B0082',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'تركواز',
                'code' => '#40E0D0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر',
                'code' => '#008000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر فاتح',
                'code' => '#90EE90',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر غامق',
                'code' => '#006400',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'زيتوني',
                'code' => '#808000',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نعناعي',
                'code' => '#98FF98',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان محايدة وأنيقة
            [
                'name' => 'بيج',
                'code' => '#F5F5DC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'عاجي',
                'code' => '#FFFFF0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'كاكي',
                'code' => '#F0E68C',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أسمر',
                'code' => '#A52A2A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'شوكولاتي',
                'code' => '#D2691E',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'كامو',
                'code' => '#78866B',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان بنفسجية وأرجوانية
            [
                'name' => 'بنفسجي',
                'code' => '#800080',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'بنفسجي فاتح',
                'code' => '#EE82EE',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أرجواني',
                'code' => '#9370DB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'لافندر',
                'code' => '#E6E6FA',
                'created_at' => now(),
                'updated_at' => now()
            ],

            
            // ألوان موضة وعصرية
            [
                'name' => 'مرجاني',
                'code' => '#FF7F50',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'سلمون',
                'code' => '#FA8072',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'خوخي',
                'code' => '#FFDAB9',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'وردي غسق',
                'code' => '#E75480',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'زهرة الكرز',
                'code' => '#DE3163',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'تين',
                'code' => '#A0522D',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أحمر النبيذ',
                'code' => '#722F37',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أحمر بورجوندي',
                'code' => '#800020',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'زيتوني غامق',
                'code' => '#556B2F',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر غابة',
                'code' => '#228B22',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق بحري',
                'code' => '#1E3A8A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'سماوي غامق',
                'code' => '#00CED1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'تركواز غامق',
                'code' => '#00B2B2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان معدنية
            [
                'name' => 'ذهبي معدني',
                'code' => '#D4AF37',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'فضي معدني',
                'code' => '#C9C0BB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'برونزي',
                'code' => '#CD7F32',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نحاسي',
                'code' => '#B87333',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان فاتحة وناعمة
            [
                'name' => 'أبيض ثلجي',
                'code' => '#FFFAFA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق فاتح جداً',
                'code' => '#F0F8FF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر فاتح جداً',
                'code' => '#F5FFFA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'وردي فاتح جداً',
                'code' => '#FFF0F5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'كريمي',
                'code' => '#FFFDD0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان داكنة وجريئة
            [
                'name' => 'أسود فحمي',
                'code' => '#343434',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'رمادي فولاذي',
                'code' => '#4682B4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'بني غامق',
                'code' => '#654321',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أزرق منتصف الليل',
                'code' => '#191970',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'أخضر منتصف الليل',
                'code' => '#004953',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان الباستيل
            [
                'name' => 'باستيل وردي',
                'code' => '#FFD1DC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'باستيل أزرق',
                'code' => '#AEC6CF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'باستيل أخضر',
                'code' => '#C1E1C1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'باستيل أصفر',
                'code' => '#FFFAA0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'باستيل بنفسجي',
                'code' => '#CBC3E3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ألوان نيون ومشرقة
            [
                'name' => 'نيون وردي',
                'code' => '#FF6EC7',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نيون أخضر',
                'code' => '#39FF14',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نيون أزرق',
                'code' => '#1F51FF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نيون برتقالي',
                'code' => '#FF5F1F',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'نيون أصفر',
                'code' => '#FFFF00',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}   
