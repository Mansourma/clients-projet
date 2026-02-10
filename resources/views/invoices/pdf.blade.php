<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        /* Styles pour le PDF */
    </style>
</head>
<body>
    <h1>Facture #{{ $invoice->invoice_number }}</h1>
    <p>Date: {{ $invoice->generated_at }}</p>
    <p>Service: {{ $invoice->service->name }}</p>
    <p>Montant: {{ $invoice->amount }}</p>
    <!-- Ajoutez d'autres détails ici -->
</body>
</html>
