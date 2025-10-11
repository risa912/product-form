<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapping = [
            1 => [3, 4], // キウイ：秋(3), 冬(4)
            2 => [1],    // ストロベリー：春(1)
            3 => [4],    // オレンジ：冬(4)
            4 => [2],    // スイカ：夏(2)
            5 => [2],    // ピーチ：夏(2)
            6 => [2, 3], // シャインマスカット：夏(2), 秋(3)
            7 => [1, 2], // パイナップル：春(1), 夏(2)
            8 => [2, 3], // ブドウ：夏(2), 秋(3)
            9 => [2],    // バナナ：夏(2)
            10 => [1,2], // メロン：春(1), 夏(2)
        ];

        foreach ($mapping as $productId => $seasonIds) {
            foreach ($seasonIds as $seasonId) {
                DB::table('product_season')->insert([
                    'product_id' => $productId,
                    'season_id' => $seasonId,
                ]);
            }
        }
    }
}
