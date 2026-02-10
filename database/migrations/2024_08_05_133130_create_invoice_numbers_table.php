<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceNumbersTable extends Migration
{
public function up()
{
if (!Schema::hasTable('invoice_numbers')) {
Schema::create('invoice_numbers', function (Blueprint $table) {
$table->id();
$table->string('invoice_type'); // 'regular' or 'subscription'
$table->bigInteger('last_number')->default(0);
$table->timestamps();
});

// Initialize records for both regular and subscription invoices
DB::table('invoice_numbers')->insert([
['invoice_type' => 'regular', 'last_number' => 0],
['invoice_type' => 'subscription', 'last_number' => 0],
]);
}
}

public function down()
{
Schema::dropIfExists('invoice_numbers');
}
}