<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Types;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        for( $i = 0; $i < 10; $i++ ) {
            $type = Types::inRandomOrder()->first();
            $new_project = new Project();
            $new_project->title = $faker->sentence();
            $new_project->content = $faker->text(1000);
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->types_id = $type->id;
            $new_project->save();
        }
    }
}
