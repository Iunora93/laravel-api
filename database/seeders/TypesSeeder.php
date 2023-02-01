<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Types;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Schema::disableForeignKeyConstraints();
        Types::truncate();
        Schema::enableForeignKeyConstraints();

        $types = ['Frontend', 'Backend', 'Devops', 'AI'];

        foreach( $types as $type ) {
            $new_type = New Types();
            $new_type->name = $type;
            $new_type->slug = Str::slug($new_type->name);

            $new_type->save();
        }
    }
}
