<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceHistoryController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.home');
    Route::resource('admins', AdminController::class);

    Route::resource('clients', ClientController::class);
    Route::get('clients/create-enterprise', [ClientController::class, 'createEnterprise'])->name('clients.create.enterprise');
    Route::post('clients/store-enterprise', [ClientController::class, 'storeEnterprise'])->name('clients.store.enterprise');
    Route::get('/clients/{client}/history', [ClientController::class, 'showHistory'])->name('clients.history');
    Route::get('/clients/{id}/last-invoice', [ClientController::class, 'showLastInvoice'])->name('clients.lastInvoice');

    // Service routes
    Route::resource('services', ServiceController::class);
    Route::get('/services/{id}/editcustom', [ServiceController::class, 'editCustom'])->name('services.editcustom');
    Route::put('/services/{service}/update_custom', [ServiceController::class, 'updateCustom'])->name('services.update_custom');
    Route::post('/services/{code_service}/update-payment-status', [ServiceController::class, 'updatePaymentStatus'])->name('services.updatePaymentStatus');
    Route::post('/services/{id}/update-validation-status', [ServiceController::class, 'updateValidationStatus'])->name('services.updateValidationStatus');
    Route::get('/services/download/{id}', [ServiceController::class, 'downloadDetails'])->name('services.downloadDetails');
    Route::post('/services/{id}/update-date', [ServiceController::class, 'updateServiceDate'])->name('services.updateDate');
    Route::post('/services/{id}/pay', [ServiceController::class, 'pay'])->name('services.pay');
    Route::post('/services/validate/{Fid}', [ServiceController::class, 'validateService'])->name('services.validateService');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/services/clone/{id}', [ServiceController::class, 'cloneService'])->name('services.clone');
    Route::get('/services/refresh', [ServiceController::class, 'refresh'])->name('services.refresh');
    Route::patch('/services/{id}/archive', [ServiceController::class, 'archive'])->name('services.archive');
    Route::get('/services/{id}/download-invoice', [ServiceController::class, 'downloadInvoice'])->name('services.downloadInvoice');
    Route::get('/services/{id}/details', [ServiceController::class, 'showInvoiceDetails'])->name('services.showInvoiceDetails');
    Route::get('/services/{id}/history', [ServiceController::class, 'history'])->name('services.history');
    Route::get('/services/{id}/download', [ServiceController::class, 'download'])->name('services.download');
    Route::get('/services/{id}/pdf', [ServiceController::class, 'generatePDF'])->name('services.pdf');
    Route::get('/services/{id}/downloadOrder', [ServiceController::class, 'downloadOrder'])->name('services.downloadOrder');
    Route::get('/service/{id}/invoice', [ServiceController::class, 'downloadInvoice'])->name('download.invoice');
    Route::get('/services-archive/client/{clientId}', [ServiceController::class, 'clientArchives'])->name('services_archive.client');
    Route::get('/services-archive/{service_id}/{client_id}/{month_year}', [ServiceController::class, 'ServiceArchiveShow'])->name('services-archive.show');
    Route::get('/services/check-status', [ServiceController::class, 'checkStatus'])->name('services.checkStatus');
    Route::get('/services/{id}/download-invoice', [ServiceController::class, 'downloadInvoice'])->name('services.download_invoice');
    Route::post('/services/{id}/update-status', [ServiceController::class, 'updateServiceStatus'])->name('services.updateStatus');


    Route::get('/client/{clientId}/download-order/{serviceId}', [ClientController::class, 'downloadOrder'])->name('client.downloadOrder');
    Route::get('services/invoice/{id}/download', [ServiceController::class, 'downloadInvoice'])->name('services.downloadInvoice');


    Route::get('/services/{id}/historyfacture', [ServiceController::class, 'showHistoryFacture'])->name('services.historyfacture');
    Route::get('/services/download/{id}', [ServiceController::class, 'factureserviseHistry'])->name('services.downloadPDF');


    Route::get('invoices/downloadPDF/{id}', [ServiceController::class, 'downloadPDFserv'])->name('invoices.downloadPDF');

Route::get('services/{id}/factures', [ServiceController::class, 'showFactures'])->name('services.showFactures');
Route::get('services/{id}/downloadPDF', [ServiceController::class, 'downloadPDF'])->name('services.downloadPDF');
Route::get('/services/filter', [ServiceController::class, 'filter'])->name('services.filter');



















});
