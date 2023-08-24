<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NoteGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('note_groups')->insert([
            [
                'user_id' => 1,
                'title' => 'MEMO',
                'save_duration' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}