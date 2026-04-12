<?php 

namespace Store\Store\Updates\Seeders;

use Seeder;
use DB ;

class SeedProductTaxesTable extends Seeder
{
    public function run()
    {
        DB::table('store_store_product_taxes')->insert([
            // ضرائب أساسية
            [
                'title' => 'ضريبة القيمة المضافة 15%',
                'price' => 15.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة القيمة المضافة 5%',
                'price' => 5.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة القيمة المضافة 10%',
                'price' => 10.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'بدون ضريبة',
                'price' => 0.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ضرائب خاصة
            [
                'title' => 'ضريبة السلع الكمالية 20%',
                'price' => 20.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة المجوهرات 25%',
                'price' => 25.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة المستورد 12%',
                'price' => 12.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة بيئية 3%',
                'price' => 3.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة الخدمة 8%',
                'price' => 8.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة الحجم (للأحذية) 7%',
                'price' => 7.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ضرائب حسب الدول
            [
                'title' => 'ضريبة السعودية 15%',
                'price' => 15.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة الإمارات 5%',
                'price' => 5.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة قطر 0%',
                'price' => 0.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة البحرين 10%',
                'price' => 10.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة الكويت 0%',
                'price' => 0.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة عمان 5%',
                'price' => 5.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // ضرائب خاصة بالمنتجات
            [
                'title' => 'ضريبة المنتجات الجلدية 18%',
                'price' => 18.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة المنتجات الإلكترونية 15%',
                'price' => 15.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة العطور 20%',
                'price' => 20.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'ضريبة مواد التجميل 25%',
                'price' => 25.00,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}   
