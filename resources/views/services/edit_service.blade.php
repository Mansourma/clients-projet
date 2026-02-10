@extends('partials.app')
@section('title', 'Edit service')
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
    <h1>Edit Service </h1>

    <form action="{{ route('services.update_custom', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                        <option value="Professional Photography" {{ $service->service_name == 'Professional Photography' ? 'selected' : '' }}>Professional Photography</option>
                        <option value="Product Photography" {{ $service->service_name == 'Product Photography' ? 'selected' : '' }}>Product Photography</option>
                        <option value="Photo Editing and Retouching" {{ $service->service_name == 'Photo Editing and Retouching' ? 'selected' : '' }}>Photo Editing and Retouching</option>
                        <option value="Photo Restoration and Digitization" {{ $service->service_name == 'Photo Restoration and Digitization' ? 'selected' : '' }}>Photo Restoration and Digitization</option>
                        <option value="Video Production and Editing" {{ $service->service_name == 'Video Production and Editing' ? 'selected' : '' }}>Video Production and Editing</option>
                        <option value="Drone Photography and Videography" {{ $service->service_name == 'Drone Photography and Videography' ? 'selected' : '' }}>Drone Photography and Videography</option>
                    </optgroup>
                    <optgroup label="Audio Production">
                        <option value="Music Production and Recording" {{ $service->service_name == 'Music Production and Recording' ? 'selected' : '' }}>Music Production and Recording</option>
                        <option value="Podcast Production" {{ $service->service_name == 'Podcast Production' ? 'selected' : '' }}>Podcast Production</option>
                        <option value="Voice-over Recording" {{ $service->service_name == 'Voice-over Recording' ? 'selected' : '' }}>Voice-over Recording</option>
                        <option value="Audio Mixing and Mastering" {{ $service->service_name == 'Audio Mixing and Mastering' ? 'selected' : '' }}>Audio Mixing and Mastering</option>
                        <option value="Audio Restoration and Cleaning" {{ $service->service_name == 'Audio Restoration and Cleaning' ? 'selected' : '' }}>Audio Restoration and Cleaning</option>
                    </optgroup>
                    <optgroup label="Programming and Web Development">
                        <option value="Website Design and Development" {{ $service->service_name == 'Website Design and Development' ? 'selected' : '' }}>Website Design and Development</option>
                        <option value="Web Application Development" {{ $service->service_name == 'Web Application Development' ? 'selected' : '' }}>Web Application Development</option>
                        <option value="E-commerce Solutions and Online Stores" {{ $service->service_name == 'E-commerce Solutions and Online Stores' ? 'selected' : '' }}>E-commerce Solutions and Online Stores
                        </option>
                        <option value="Content Management Systems (CMS) Development" {{ $service->service_name == 'Content Management Systems (CMS) Development' ? 'selected' : '' }}>Content Management Systems (CMS)
                            Development</option>
                        <option value="Custom Software Development" {{ $service->service_name == 'Custom Software Development' ? 'selected' : '' }}>Custom Software Development</option>
                        <option value="Mobile App Development (iOS, Android)" {{ $service->service_name == 'Mobile App Development (iOS, Android)' ? 'selected' : '' }}>Mobile App Development (iOS, Android)</option>
                        <option value="Database Design and Development" {{ $service->service_name == 'Database Design and Development' ? 'selected' : '' }}>Database Design and Development</option>
                        <option value="API Integration and Development" {{ $service->service_name == 'API Integration and Development' ? 'selected' : '' }}>API Integration and Development</option>
                        <option value="Website Maintenance and Support" {{ $service->service_name == 'Website Maintenance and Support' ? 'selected' : '' }}>Website Maintenance and Support</option>
                    </optgroup>
                    <optgroup label="Graphic Design">
                        <option value="Logo Design and Branding" {{ $service->service_name == 'Logo Design and Branding' ? 'selected' : '' }}>Logo Design and Branding</option>
                        <option value="Print Design" {{ $service->service_name == 'Print Design' ? 'selected' : '' }}>Print Design</option>
                        <option value="Packaging Design" {{ $service->service_name == 'Packaging Design' ? 'selected' : '' }}>Packaging Design</option>
                        <option value="Advertising Design" {{ $service->service_name == 'Advertising Design' ? 'selected' : '' }}>Advertising Design</option>
                        <option value="Illustrations and Infographics" {{ $service->service_name == 'Illustrations and Infographics' ? 'selected' : '' }}>Illustrations and Infographics</option>
                        <option value="Typography and Layout Design" {{ $service->service_name == 'Typography and Layout Design' ? 'selected' : '' }}>Typography and Layout Design</option>
                        <option value="Social Media Graphics" {{ $service->service_name == 'Social Media Graphics' ? 'selected' : '' }}>Social Media Graphics</option>
                        <option value="Digital and Print Asset Creation" {{ $service->service_name == 'Digital and Print Asset Creation' ? 'selected' : '' }}>Digital and Print Asset Creation</option>
                        <option value="Visual Content Creation for Websites and Blogs" {{ $service->service_name == 'Visual Content Creation for Websites and Blogs' ? 'selected' : '' }}>Visual Content Creation for Websites
                            and Blogs</option>
                    </optgroup>
                    <optgroup label="Visual Identity Design">
                        <option value="Brand Identity Development" {{ $service->service_name == 'Brand Identity Development' ? 'selected' : '' }}>Brand Identity Development</option>
                        <option value="Logo Design and Variations" {{ $service->service_name == 'Logo Design and Variations' ? 'selected' : '' }}>Logo Design and Variations</option>
                        <option value="Color Palette and Typography Selection" {{ $service->service_name == 'Color Palette and Typography Selection' ? 'selected' : '' }}>Color Palette and Typography Selection
                        </option>
                        <option value="Brand Style Guide Creation" {{ $service->service_name == 'Brand Style Guide Creation' ? 'selected' : '' }}>Brand Style Guide Creation</option>
                        <option value="Stationery Design" {{ $service->service_name == 'Stationery Design' ? 'selected' : '' }}>Stationery Design</option>
                        <option value="Brand Collateral Design: Amplifying Your Brand’s Impact" {{ $service->service_name == 'Brand Collateral Design: Amplifying Your Brand’s Impact' ? 'selected' : '' }}>Brand Collateral Design:
                            Amplifying Your Brand’s Impact</option>
                        <option value="Brand Asset Creation" {{ $service->service_name == 'Brand Asset Creation' ? 'selected' : '' }}>Brand Asset Creation</option>
                    </optgroup>
                    <optgroup label="Motion Graphics">
                        <option value="Animated Videos and Explainer Videos" {{ $service->service_name == 'Animated Videos and Explainer Videos' ? 'selected' : '' }}>Animated Videos and Explainer Videos</option>
                        <option value="Motion Design for Commercials and Ads" {{ $service->service_name == 'Motion Design for Commercials and Ads' ? 'selected' : '' }}>Motion Design for Commercials and Ads</option>
                        <option value="Title Sequences for Films and TV Shows" {{ $service->service_name == 'Title Sequences for Films and TV Shows' ? 'selected' : '' }}>Title Sequences for Films and TV Shows
                        </option>
                        <option value="Animated Infographics" {{ $service->service_name == 'Animated Infographics' ? 'selected' : '' }}>Animated Infographics</option>
                        <option value="Logo Animations and Stingers" {{ $service->service_name == 'Logo Animations and Stingers' ? 'selected' : '' }}>Logo Animations and Stingers</option>
                        <option value="Visual Effects and Compositing" {{ $service->service_name == 'Visual Effects and Compositing' ? 'selected' : '' }}>Visual Effects and Compositing</option>
                    </optgroup>
                    <optgroup label="Covering and Organizing Events">
                        <option value="Event Photography and Videography" {{ $service->service_name == 'Event Photography and Videography' ? 'selected' : '' }}>Event Photography and Videography</option>
                        <option value="Live Streaming Services" {{ $service->service_name == 'Live Streaming Services' ? 'selected' : '' }}>Live Streaming Services</option>
                        <option value="Event Planning and Coordination" {{ $service->service_name == 'Event Planning and Coordination' ? 'selected' : '' }}>Event Planning and Coordination</option>
                        <option value="Venue Selection and Logistics Management" {{ $service->service_name == 'Venue Selection and Logistics Management' ? 'selected' : '' }}>Venue Selection and Logistics Management
                        </option>
                        <option value="Equipment Rental and Setup" {{ $service->service_name == 'Equipment Rental and Setup' ? 'selected' : '' }}>Equipment Rental and Setup</option>
                        <option value="Event Marketing and Promotion" {{ $service->service_name == 'Event Marketing and Promotion' ? 'selected' : '' }}>Event Marketing and Promotion</option>
                        <option value="Registration and Ticketing Management" {{ $service->service_name == 'Registration and Ticketing Management' ? 'selected' : '' }}>Registration and Ticketing Management</option>
                        <option value="On-site Event Support" {{ $service->service_name == 'On-site Event Support' ? 'selected' : '' }}>On-site Event Support</option>
                        <option value="Post-event Evaluation and Analysis" {{ $service->service_name == 'Post-event Evaluation and Analysis' ? 'selected' : '' }}>Post-event Evaluation and Analysis</option>
                    </optgroup>
                    <optgroup label="Cybersecurity">
                        <option value="Vulnerability Assessment and Penetration Testing (VAPT)" {{ $service->service_name == 'Vulnerability Assessment and Penetration Testing (VAPT)' ? 'selected' : '' }}>Vulnerability Assessment and
                            Penetration Testing (VAPT)</option>
                        <option value="Intrusion Detection and Prevention Systems (IDPS)" {{ $service->service_name == 'Intrusion Detection and Prevention Systems (IDPS)' ? 'selected' : '' }}>Intrusion Detection and Prevention
                            Systems (IDPS)</option>
                        <option value="Firewall Management" {{ $service->service_name == 'Firewall Management' ? 'selected' : '' }}>Firewall Management</option>
                        <option value="Endpoint Security" {{ $service->service_name == 'Endpoint Security' ? 'selected' : '' }}>Endpoint Security</option>
                        <option value="Digital Analysis and Incident Response" {{ $service->service_name == 'Digital Analysis and Incident Response' ? 'selected' : '' }}>Digital Analysis and Incident Response
                        </option>
                        <option value="Security Information and Event Management (SIEM)" {{ $service->service_name == 'Security Information and Event Management (SIEM)' ? 'selected' : '' }}>Security Information and Event
                            Management (SIEM)</option>
                        <option value="Identity and Access Management (IAM)" {{ $service->service_name == 'Identity and Access Management (IAM)' ? 'selected' : '' }}>Identity and Access Management (IAM)</option>
                        <option value="Security Awareness Training" {{ $service->service_name == 'Security Awareness Training' ? 'selected' : '' }}>Security Awareness Training</option>
                        <option value="Data Encryption" {{ $service->service_name == 'Data Encryption' ? 'selected' : '' }}>Data Encryption</option>
                        <option value="Security Consulting" {{ $service->service_name == 'Security Consulting' ? 'selected' : '' }}>Security Consulting</option>
                        <option value="Cloud Security Services" {{ $service->service_name == 'Cloud Security Services' ? 'selected' : '' }}>Cloud Security Services</option>
                        <option value="Mobile Security" {{ $service->service_name == 'Mobile Security' ? 'selected' : '' }}>Mobile Security</option>
                        <option value="Regulatory Compliance Services" {{ $service->service_name == 'Regulatory Compliance Services' ? 'selected' : '' }}>Regulatory Compliance Services</option>
                        <option value="Security Patch Management" {{ $service->service_name == 'Security Patch Management' ? 'selected' : '' }}>Security Patch Management</option>
                    </optgroup>
                </select>
                @error('service_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="services_status" value="{{ old('services_status', $service->services_status ?? '') }}">

            <input type="hidden" name="validation_status" value="{{ old('validation_status', $service->validation_status ?? '') }}">


            <!-- Subscription Type -->
            <div class="form-group col-md-6">
                <label for="is_subscription" class="font-weight-bold">Is it a subscription ?</label>
                <select name="is_subscription" id="is_subscription" class="form-control" onchange="toggleSubscriptionFields()">
                    <option value="">-- Select --</option>
                    <option value="1" {{ $service->is_subscription == '1' ? 'selected' : '' }}>yes</option>
                    <option value="0" {{ $service->is_subscription == '0' ? 'selected' : '' }}>no</option>
                </select>
            </div>
        </div>

        <!-- Subscription Fields -->
        <div id="subscription_fields" class="subscription-fields" style="display: {{ $service->is_subscription == '1' ? 'block' : 'none' }}">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="subscription_duration">Subscription Duration</label>
                    <select name="subscription_duration" id="subscription_duration" class="form-control text-center font-weight-bold">
                        <option value="" >-- Select --</option>
                        <option value="1" {{ $service->subscription_duration == '1' ? 'selected' : '' }}>1 month</option>
                        <option value="3" {{ $service->subscription_duration == '3' ? 'selected' : '' }}>3 months</option>
                        <option value="6" {{ $service->subscription_duration == '6' ? 'selected' : '' }}>6 months</option>
                        <option value="12" {{ $service->subscription_duration == '12' ? 'selected' : '' }}>12 months</option>
                        <option value="24" {{ $service->subscription_duration == '24' ? 'selected' : '' }}>24 months</option>
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
                    <option value="payé" {{ $service->payment_status == 'payé' ? 'selected' : '' }}>Paid</option>
                    <option value="non-payé" {{ $service->payment_status == 'non-payé' ? 'selected' : '' }}>Not Paid</option>
                    <option value="subscription end" {{ $service->payment_status == 'subscription end' ? 'selected' : '' }}>Subscription End</option>
                </select>
                @error('payment_status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" placeholder="Enter price" value="{{ $service->price }}" class="form-control">
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="mode_payment">Payment Method</label>
                <select name="mode_payment" id="mode_payment" class="form-control">
                    <option value="espece" {{ $service->mode_payment == 'espece' ? 'selected' : '' }}>Espèce</option>
                    <option value="cheque" {{ $service->mode_payment == 'cheque' ? 'selected' : '' }}>Cheque</option>
                    <option value="effet" {{ $service->mode_payment == 'effet' ? 'selected' : '' }}>effet</option>
                    <option value="verment" {{ $service->mode_payment == 'verment' ? 'selected' : '' }}>verment</option>
                    <option value="versement" {{ $service->mode_payment == 'versement' ? 'selected' : '' }}>versement</option>
                    <option value="composation" {{ $service->mode_payment == 'composation' ? 'selected' : '' }}>composation</option>

                </select>
                @error('payment_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Service Description -->
            <div class="form-group col-md-6">
                <label for="service_description">Service Description</label>
                <textarea name="service_description" id="service_description" placeholder="Enter service description" class="form-control">{{ $service->service_description }}</textarea>
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
            <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-save"></i> Save</button>
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
