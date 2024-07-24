<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('phone')->nullable()->after('password');
            $table->string('address')->nullable()->after('phone');
            $table->string('country')->nullable()->after('address');
            $table->string('city')->nullable()->after('country');
            $table->string('district')->nullable()->after('city');
            $table->string('province')->nullable()->after('district');
            $table->string('postal_code')->nullable()->after('district');
            $table->string('roles')->default('user')->after(('postal_code'));
            $table->string('image')->nullable()->after('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'country',
                'city',
                'district',
                'province',
                'postal_code',
                'roles',
                'image'
            ]);
        });
    }
};
