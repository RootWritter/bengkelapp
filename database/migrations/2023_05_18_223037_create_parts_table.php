<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id()->index();
            $table->uuid()->default(Str::uuid());
            $table->enum('brand', ['Yamaha', 'Honda', 'Suzuki', 'Kawasaki', 'Lainnya'])->default('Lainnya');
            $table->string('name');
            $table->string('code');
            $table->longText('photo');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
