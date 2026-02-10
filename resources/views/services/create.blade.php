@extends('partials.app')
@section('title', 'Create service')
@section('main')
<style>
    body {
        background-color: #f4f4f4;
    }

    .custom-form-container {
        width: 90%;
        margin: auto;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-form-container h1 {
        color: #000;
        font-size: 2rem;
        border-bottom: 2px solid #D3AC47;
        padding-bottom: 10px;
    }

    .form-row {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: bold;
        color: #000;
    }

    .form-control {
        border-color: #D3AC47;
        border-radius: 4px;
    }

    .form-control:focus {
        border-color: #D3AC47;
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.25);
    }

    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
        color: #dc3545;
    }

    .btn-primary {
        background-color: #D3AC47;
        border-color: #D3AC47;
        color: #000;
    }

    .btn-primary:hover {
        background-color: #b89a3a;
        border-color: #a6822d;
    }

    .btn-primary:focus, .btn-primary.focus {
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.5);
    }

    .client-fields {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
</style>

<div class="custom-form-container">
    <h1>Add Service </h1>

    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <!-- Client Information -->
        <div class="form-group client-fields">
            @if ($client->client_type == 'enterprise')
            <label for="enterprise_name">Enterprise Name</label>
            <input type="text" name="enterprise_name" value="{{ $client->enterprise_name }}" class="form-control" readonly>
            <label for="legal_representative_name_enterprise" class="mt-2">Legal Representative Name</label>
             <input type="text" name="client_name" value="{{ $client->legal_representative_name_enterprise }} {{ $client->legal_representative_prenom_enterprise }}" class="form-control" readonly>

            @else
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" value="{{ $client->name_client }} {{ $client->prenom_client }}" class="form-control" readonly>
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            @endif
        </div>

        <div class="form-row">
            <!-- Service Name -->
            <div class="form-group col-md-6">
                <label for="service_name" class="font-weight-bold"> Service Name</label>
                <select name="service_name" id="service_name" class="form-control">
                    <option value="">-- Select Service --</option>
                    <optgroup label="Photography and Visual Production">
                        <option value="Professional Photography">Professional Photography</option>
                        <option value="Product Photography">Product Photography</option>
                        <option value="Photo Editing and Retouching">Photo Editing and Retouching</option>
                        <option value="Photo Restoration and Digitization">Photo Restoration and Digitization</option>
                        <option value="Video Production and Editing">Video Production and Editing</option>
                        <option value="Drone Photography and Videography">Drone Photography and Videography</option>
                    </optgroup>
                    <optgroup label="Audio Production">
                        <option value="Music Production and Recording">Music Production and Recording</option>
                        <option value="Podcast Production">Podcast Production</option>
                        <option value="Voice-over Recording">Voice-over Recording</option>
                        <option value="Audio Mixing and Mastering">Audio Mixing and Mastering</option>
                        <option value="Audio Restoration and Cleaning">Audio Restoration and Cleaning</option>
                    </optgroup>
                    <optgroup label="Programming and Web Development">
                        <option value="Website Design and Development">Website Design and Development</option>
                        <option value="Web Application Development">Web Application Development</option>
                        <option value="E-commerce Solutions and Online Stores">E-commerce Solutions and Online Stores
                        </option>
                        <option value="Content Management Systems (CMS) Development">Content Management Systems (CMS)
                            Development</option>
                        <option value="Custom Software Development">Custom Software Development</option>
                        <option value="Mobile App Development (iOS, Android)">Mobile App Development (iOS, Android)</option>
                        <option value="Database Design and Development">Database Design and Development</option>
                        <option value="API Integration and Development">API Integration and Development</option>
                        <option value="Website Maintenance and Support">Website Maintenance and Support</option>
                    </optgroup>
                    <optgroup label="Graphic Design">
                        <option value="Logo Design and Branding">Logo Design and Branding</option>
                        <option value="Print Design">Print Design</option>
                        <option value="Packaging Design">Packaging Design</option>
                        <option value="Advertising Design">Advertising Design</option>
                        <option value="Illustrations and Infographics">Illustrations and Infographics</option>
                        <option value="Typography and Layout Design">Typography and Layout Design</option>
                        <option value="Social Media Graphics">Social Media Graphics</option>
                        <option value="Digital and Print Asset Creation">Digital and Print Asset Creation</option>
                        <option value="Visual Content Creation for Websites and Blogs">Visual Content Creation for Websites
                            and Blogs</option>
                    </optgroup>
                    <optgroup label="Visual Identity Design">
                        <option value="Brand Identity Development">Brand Identity Development</option>
                        <option value="Logo Design and Variations">Logo Design and Variations</option>
                        <option value="Color Palette and Typography Selection">Color Palette and Typography Selection
                        </option>
                        <option value="Brand Style Guide Creation">Brand Style Guide Creation</option>
                        <option value="Stationery Design">Stationery Design</option>
                        <option value="Brand Collateral Design: Amplifying Your Brand’s Impact">Brand Collateral Design:
                            Amplifying Your Brand’s Impact</option>
                        <option value="Brand Asset Creation">Brand Asset Creation</option>
                    </optgroup>
                    <optgroup label="Motion Graphics">
                        <option value="Animated Videos and Explainer Videos">Animated Videos and Explainer Videos</option>
                        <option value="Motion Design for Commercials and Ads">Motion Design for Commercials and Ads</option>
                        <option value="Title Sequences for Films and TV Shows">Title Sequences for Films and TV Shows
                        </option>
                        <option value="Animated Infographics">Animated Infographics</option>
                        <option value="Logo Animations and Stingers">Logo Animations and Stingers</option>
                        <option value="Visual Effects and Compositing">Visual Effects and Compositing</option>
                    </optgroup>
                    <optgroup label="Covering and Organizing Events">
                        <option value="Event Photography and Videography">Event Photography and Videography</option>
                        <option value="Live Streaming Services">Live Streaming Services</option>
                        <option value="Event Planning and Coordination">Event Planning and Coordination</option>
                        <option value="Venue Selection and Logistics Management">Venue Selection and Logistics Management
                        </option>
                        <option value="Equipment Rental and Setup">Equipment Rental and Setup</option>
                        <option value="Event Marketing and Promotion">Event Marketing and Promotion</option>
                        <option value="Registration and Ticketing Management">Registration and Ticketing Management</option>
                        <option value="On-site Event Support">On-site Event Support</option>
                        <option value="Post-event Evaluation and Analysis">Post-event Evaluation and Analysis</option>
                    </optgroup>
                    <optgroup label="Cybersecurity">
                        <option value="Vulnerability Assessment and Penetration Testing (VAPT)">Vulnerability Assessment and
                            Penetration Testing (VAPT)</option>
                        <option value="Intrusion Detection and Prevention Systems (IDPS)">Intrusion Detection and Prevention
                            Systems (IDPS)</option>
                        <option value="Firewall Management">Firewall Management</option>
                        <option value="Endpoint Security">Endpoint Security</option>
                        <option value="Digital Analysis and Incident Response">Digital Analysis and Incident Response
                        </option>
                        <option value="Security Information and Event Management (SIEM)">Security Information and Event
                            Management (SIEM)</option>
                        <option value="Identity and Access Management (IAM)">Identity and Access Management (IAM)</option>
                        <option value="Security Awareness Training">Security Awareness Training</option>
                        <option value="Data Encryption">Data Encryption</option>
                        <option value="Security Consulting">Security Consulting</option>
                        <option value="Cloud Security Services">Cloud Security Services</option>
                        <option value="Mobile Security">Mobile Security</option>
                        <option value="Regulatory Compliance Services">Regulatory Compliance Services</option>
                        <option value="Security Patch Management">Security Patch Management</option>
                    </optgroup>
                </select>
                @error('service_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subscription Type -->
            <div class="form-group col-md-6">
                <label for="is_subscription" class="font-weight-bold">Is it a subscription ?</label>
                <select name="is_subscription" id="is_subscription" class="form-control" onchange="toggleSubscriptionFields()">
                    <option value="">-- Select --</option>
                    <option value="1" {{ old('is_subscription') == '1' ? 'selected' : '' }}>yes</option>
                    <option value="0" {{ old('is_subscription') == '0' ? 'selected' : '' }}>no</option>
                </select>
            </div>
        </div>

        <!-- Subscription Fields -->
        <div id="subscription_fields" class="subscription-fields" style="display: none;">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="subscription_duration">Subscription Duration</label>
                    <select name="subscription_duration" id="subscription_duration" class="form-control text-center font-weight-bold">
                        <option value="" >-- Select --</option>
                        <option value="1" {{ old('subscription_duration') == '1' ? 'selected' : '' }}>1 month</option>
                        <option value="3" {{ old('subscription_duration') == '3' ? 'selected' : '' }}>3 months</option>
                        <option value="6" {{ old('subscription_duration') == '6' ? 'selected' : '' }}>6 months</option>
                        <option value="12" {{ old('subscription_duration') == '12' ? 'selected' : '' }}>12 months</option>
                        <option value="24" {{ old('subscription_duration') == '24' ? 'selected' : '' }}>24 months</option>
                    </select>
                    @error('subscription_duration')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <!-- Payment Status -->
            <div class="form-group col-md-6">
                <label for="payment_status" class="font-weight-bold">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control">
                    <option value="">Select status</option>
                    <option value="payé" {{ old('payment_status') == 'payé' ? 'selected' : '' }}>Paid</option>
                    <option value="non-payé" {{ old('payment_status') == 'non-payé' ? 'selected' : '' }}>Not Paid</option>
                </select>
                @error('payment_status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" placeholder="Enter price" value="{{ old('price') }}" class="form-control">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="mode_payment">Payment Method</label>
                <select name="mode_payment" id="mode_payment" class="form-control">
                    <option value="espece" {{ old('mode_payment') == 'espece' ? 'selected' : '' }}>Espèce</option>
                    <option value="cheque" {{ old('mode_payment') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                    <option value="effet" {{ old('mode_payment') == 'effet' ? 'selected' : '' }}>effet</option>
                    <option value="verment" {{ old('mode_payment') == 'verment' ? 'selected' : '' }}>verment</option>
                    <option value="versement" {{ old('mode_payment') == 'versement' ? 'selected' : '' }}>versement</option>
                    <option value="composation" {{ old('mode_payment') == 'composation' ? 'selected' : '' }}>composation</option>

                </select>
                @error('payment_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Service Description -->
            <div class="form-group col-md-6">
                <label for="service_description">Service Description</label>
                <textarea name="service_description" id="service_description" placeholder="Enter service description" class="form-control">{{ old('service_description') }}</textarea>
                @error('service_description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tva_amount" class="font-weight-bold">TVA (20%)</label>
                <input type="text" id="tva_amount" class="form-control" readonly>
            </div>

            <!-- Total Price with TVA -->
            <div class="form-group col-md-6">
                <label for="total_price" class="font-weight-bold"> Total Price (TTC)</label>
                <input type="text" id="total_price" name="total_price" class="form-control" readonly>
            </div>
        </div>



        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Add</button>
            <a href="{{ route('services.index') }}" class="btn btn-danger mb-2"><i class="fas fa-times-circle"></i> cancel</a>
        </div>
    </form>
</div>

<script>
    function toggleSubscriptionFields() {
        var isSubscription = document.getElementById('is_subscription').value;
        var subscriptionFields = document.getElementById('subscription_fields');

        if (isSubscription === '1') {
            subscriptionFields.style.display = 'block';
        } else {
            subscriptionFields.style.display = 'none';
        }
    }

    function calculateTVA() {
        const priceInput = document.getElementById('price');
        const tvaAmountInput = document.getElementById('tva_amount');
        const totalPriceInput = document.getElementById('total_price');

        const price = parseFloat(priceInput.value);
        if (!isNaN(price)) {
            const tva = price * 0.20;
            const total = price + tva;

            tvaAmountInput.value = tva.toFixed(2);
            totalPriceInput.value = total.toFixed(2);
        } else {
            tvaAmountInput.value = '';
            totalPriceInput.value = '';
        }
    }

    document.getElementById('price').addEventListener('input', calculateTVA);
     calculateTVA();
</script>


@endsection
