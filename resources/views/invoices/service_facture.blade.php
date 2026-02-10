<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - {{ $service->invoice_number }}</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header, .footer {
            width: 100%;
            text-align: center;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            margin: 0;
            padding: 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }


        .header img  {
            width: 100%;
            height: auto;
            display: block;
            margin-top: -44px;
            padding-top: -44px;
        }

        .footer img {
            width: 100%;
            height: auto;
            display: block;
            margin: 9;
            padding: 9;
        }

        .content {
            padding-top: 140px; /* Adjust depending on header height */
            padding-bottom: 120px; /* Adjust depending on footer height */
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .heading-center {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('storage/images/header.png') }}" alt="Header Logo">
    </div>

    <!-- Invoice Content -->
    <div class="invoice-box">
        <div class="content">
            <table>
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <h1>Facture</h1>
                                </td>
                                <td>
                                    Facture No: <strong>{{ $service->invoice_number }}</strong><br>
                                    Créée le: <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <strong>De:</strong><br>
                                    RYD AGENCY<br>
                                    13 Rue Abdelkrim Benjelloun<br>
                                    immeuble achraf 1er etage<br>
                                    +212 808 5660 09<br>
                                    contact@rydagency.com
                                </td>
                                <td>
                                    <strong>Pour:</strong><br>
                                    @if($service->client->client_type === 'individual')
                                        Nom du client: <strong>{{ $service->client->name_client }}</strong><br>
                                        Prénom du client: <strong>{{ $service->client->prenom_client }}</strong><br>
                                        Client ID: <strong>{{ $service->client->code_client }}</strong><br>
                                        Adresse du client: <strong>{{ $service->client->address_client }}</strong><br>
                                        <strong>{{ $service->client->address_client2 }}</strong> <br>
                                        Téléphone: <strong>{{ $service->client->telephone_client }}</strong>
                                    @elseif($service->client->client_type === 'society')
                                        Nom de l'entreprise: <strong>{{ $service->client->enterprise_name }}</strong><br>
                                        ICE : <strong>{{ $service->client->ice_enterprise }}</strong><br>
                                        Représentant légal: <strong>{{ $service->client->legal_representative_name_enterprise }}</strong> {{ $service->client->legal_representative_prenom_enterprise }}<br>
                                        Entreprise ID: <strong>{{ $service->client->code_client }}</strong><br>
                                        Adresse de l'entreprise: <strong>{{ $service->client->address_enterprise }}</strong><br>
                                        <strong>{{ $service->client->address_enterprise2 }}</strong> <br>
                                        Téléphone: <strong>{{ $service->client->telephone_enterprise }}</strong>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Description du service</td>
                    <td>Prix</td>
                </tr>

                <tr class="item">
                    <td>{{ $service->service_name }} ({{ $service->service_code }})</td>
                    <td>{{ number_format($service->price, 2) }} MAD</td>
                </tr>

                <tr class="heading">
                    <td>Statut de Paiement</td>
                    <td>Statut de Validation</td>
                </tr>

                <tr class="details">
                    <td>{{ ucfirst($service->payment_status) }}</td>
                    <td>{{ ucfirst($service->validation_status) }}</td>
                </tr>

                <tr class="heading">
                    <td>Durée de l'abonnement</td>
                    <td>Prochaine date de facturation</td>
                </tr>

                <tr class="details">
                    <td>{{ $service->subscription_duration ? $service->subscription_duration . ' mois ' : 'N/A' }}</td>
                    <td>{{ $service->due_date ? \Carbon\Carbon::parse($service->due_date)->format('d/m/Y') : 'N/A' }}</td>
                </tr>

                <!-- Displaying TVA and Total Price -->
                <tr class="heading">
                    <td>TVA (20%)</td>
                    <td>Total TTC: {{ number_format($service->total_price, 2) }} MAD</td>
                </tr>
            </table>

            <div class="heading-center">
                <p>Merci pour votre confiance !</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('storage/images/footer.png') }}" alt="Footer Logo">
    </div>
</body>
</html>
