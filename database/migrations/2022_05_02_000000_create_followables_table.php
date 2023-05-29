<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowablesTable extends Migration
{
    public function up(): void
    {
        Schema::create(config('follow.followables_table', 'followables'), function (Blueprint $table) {
            if (config('follow.uuids')) {
                $table->uuid('id')->primary();
            } else {
                $table->id();
            }
            $table->foreignUuid(config('follow.user_foreign_key', 'user_id'))->index()->comment('user_id');
            if (config('follow.uuids')) {
                $table->uuidMorphs('followable');
            } else {
                $table->morphs('followable');
            }

            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();

            $table->index(['followable_type', 'accepted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('follow.followables_table', 'followables'));
    }
}
