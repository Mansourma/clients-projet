<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Validated - {{ $companyName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #111;
            border: 1px solid #d3ac47;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        h1 {
            color: #d3ac47;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #d3ac47;
            padding-bottom: 10px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #fff;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #d3ac47;
            border-top: 1px solid #d3ac47;
            padding-top: 20px;
            text-align: center;
        }
        .footer p {
            margin: 5px 0;
        }
        .contact-info {
            margin-top: 20px;
            line-height: 1.8;
        }
        .social-media {
            margin-top: 20px;
        }
        .social-media a {
            color: #d3ac47;
            margin: 0 15px;
            text-decoration: none;
            display: inline-block;
        }
        .social-media img {
            width: 24px;
            height: 24px;
            vertical-align: middle;
        }
        .copyright {
            margin-top: 20px;
            font-size: 12px;
            color: #d3ac47;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://rydagency.com/wp-content/uploads/2022/05/logo.png" alt="{{ $companyName }} Logo">
        </div>
        <h1>Service Validated - {{ $serviceName }}</h1>
        @if ($clientType === 'individual')
        <p>Dear {{ $clientName }},</p>
        @elseif ($clientType === 'society')
        <p>Dear {{ $enterpriseName }},</p>
        @endif

        <p>We are pleased to inform you that your service "{{ $serviceName }}" has been successfully validated.</p>
        <p>Attached to this email is a copy of the invoice (Invoice No: {{ $invoiceNumber }}) for your records. If you have any questions or require further assistance, please do not hesitate to contact us at <a href="mailto:contact@rydagency.com" style="color: #d3ac47;">contact@rydagency.com</a>.</p>

        <div class="footer">
            <div class="contact-info">
                <p><strong>Contact Us:</strong> +212 808 5660 09 | <a href="mailto:contact@rydagency.com" style="color: #d3ac47;">contact@rydagency.com</a></p>
                <p><strong>Address:</strong> 13 Rue Abdelkrim Benjelloun, Immeuble Achraf, 1er etage</p>
            </div>
            <div class="social-media">
                <a href="https://www.facebook.com/rydmediatechagency/"><img src="https://cdn-icons-png.flaticon.com/128/5968/5968764.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/rydcompany"><img src="https://cdn-icons-png.flaticon.com/128/1384/1384063.png" alt="Instagram"></a>
                <a href="https://www.linkedin.com/company/ryd-agency"><img src="https://cdn-icons-png.flaticon.com/128/4494/4494497.png" alt="LinkedIn"></a>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} Ryd MEDIATECH. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
