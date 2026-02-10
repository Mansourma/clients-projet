<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivedServicesTable extends Migration
{
    public function up()
    {
        Schema::create('archived_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_code');
            $table->string('service_name');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('code_client');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_subscription');
            $table->string('duration');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->string('payment_status');
            $table->string('status');
            $table->string('order_bond')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archived_services');
    }
}