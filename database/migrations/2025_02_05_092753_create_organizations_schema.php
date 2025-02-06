<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('activities')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('building_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('organization_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('organization_activity', function (Blueprint $table) {
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->primary(['organization_id', 'activity_id']);
        });
    }

    public function down() {
        Schema::dropIfExists('organization_activity');
        Schema::dropIfExists('organization_phones');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('buildings');
    }
};
