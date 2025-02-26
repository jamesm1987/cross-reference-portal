<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Part;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('part_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Part::class);
            $table->string('o_dia')->nullable();
            $table->string('height')->nullable();
            $table->string('bearing_height')->nullable();
            $table->string('bearing_o_dia')->nullable();
            $table->string('bore_diameter')->nullable();
            $table->string('stud_hole_dia')->nullable();
            $table->string('hub_weight')->nullable();
            $table->string('bearing_weight')->nullable();
            $table->string('disc_weight')->nullable();
            $table->string('total_weight')->nullable();
            $table->string('box_type')->nullable();
            $table->string('box_dimension')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_metas');
    }
};
