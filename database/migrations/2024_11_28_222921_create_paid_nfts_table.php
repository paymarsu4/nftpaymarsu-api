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
        Schema::create('paid_nfts', function (Blueprint $table) {
            $table->id();
            // $table->integer('nft_id');
            $table->integer('user_id');
            $table->double('paid_price', 4,2)->default(0);
            $table->date('datepaid');
            $table->integer('token_id');
            $table->string('wallet_address_from', 150);
            $table->string('wallet_address_to', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paid_nfts');
    }
};
