<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'user_id' => 1,
                'note_group_id'=>1,
                'body' => 'サンプルメモ1',
                'is_saved' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'note_group_id'=>1,
                'body' => 'サンプルメモ2',
                'is_saved' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
