<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Exécuter la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('service_name');
            $table->boolean('is_subscription');
            $table->string('service_code', 8)->unique();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('tva', 8, 2)->default(20.00);
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->text('service_description')->nullable();
            $table->datetime('due_date')->nullable();
            $table->datetime('dernier_paiement')->nullable();
            $table->integer('subscription_duration')->nullable();
            $table->integer('remains_subscription')->nullable();
            $table->date('subscription_end_date')->nullable();
            $table->enum('services_status', ['encour', 'a faire', 'fini'])->default('encour');
            $table->enum('payment_status', ['payé', 'non payé','subscription end'])->default('non payé');
            $table->enum('mode_payment', ['espece', 'cheque', 'effet', 'verment', 'versement', 'tpe', 'composation', 'autre']);
            $table->enum('validation_status', ['validé', 'non-validé', 'en cours'])->default('non-validé');
            $table->timestamps();
            $table->datetime('service_start_date')->nullable();
            $table->string('invoice_number')->nullable();



        });
    }

    /**
     * Revenir en arrière sur la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
