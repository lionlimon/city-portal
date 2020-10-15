<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddSlugColumnToCagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique(); 
        });

        // $categories = DB::connection('connections_string')->table('categories')->get();

        // foreach($categories as $category)
        // {
        //     $category->slug = Str::slug(mb_substr($category->name, 0, 40), '-');
        //     $category->save();
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
