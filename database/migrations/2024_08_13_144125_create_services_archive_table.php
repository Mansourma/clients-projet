<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_archive', function (Blueprint $table) {
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->string('service_name');
            $table->tinyInteger('is_subscription');
            $table->string('service_code', 8);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->text('service_description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('dernier_paiement')->nullable();
            $table->integer('subscription_duration')->nullable();
            $table->string('services_status');
            $table->enum('payment_status', ['payé', 'non payé']);
            $table->enum('validation_status', ['validé', 'non-validé', 'en cours']);
            $table->timestamps();
            $table->date('service_start_date')->nullable();
            $table->date('service_end_date')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('formatted_id')->nullable();
            $table->string('status')->nullable();
            $table->string('month_year');
            $table->primary(['service_id', 'client_id', 'month_year']);

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_archive');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

}
