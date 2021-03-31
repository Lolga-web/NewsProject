<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert($this->getData());
    }

    private function getData(){
        $data = [
            [
                'title' => 'LENTA.ru',
                'url' => 'https://lenta.ru/rss/news'
            ],
            [
                'title' => 'ВЕСТИ.ru',
                'url' => 'https://www.vesti.ru/vesti.rss'
            ]
        ];

        return $data;
    }
}
