<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Foreign key to packages (nullable so booking survives package deletion)
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')
                  ->references('id')->on('packages')
                  ->onDelete('set null');

            $table->string('full_name');
            $table->string('email')->index();
            $table->string('phone');
            $table->string('service');          // snapshot of package name at booking time
            $table->date('booking_date');
            $table->time('booking_time');
            $table->text('special_request')->nullable();
            $table->string('payment_method');   // 'visa' | 'qris'
            $table->decimal('price', 10, 2)->nullable();
            $table->string('booking_reference')->unique()->index();
            $table->string('status')->default('Scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
