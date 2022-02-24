<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MovieFormat;

return new class extends Migration
{
    public function up(): void 
    {
        Schema::create('movies', 
            function (Blueprint $table): void {
                $table->id();
                $table->string('title', 50);
                $table->enum(
                    'format', 
                    [
                        MovieFormat::VHS,
                        MovieFormat::DVD,
                        MovieFormat::STREAMING,
                    ]
                );
                $table->unsignedSmallInteger('length_minutes');
                $table->unsignedSmallInteger('release_year');
                $table->tinyInteger('rating');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
