@extends('partials.app')

@section('title', 'Edit Client')

@section('main')
<style>
    body {
        background-color: #f4f4f4;
    }

    .custom-form-container {
        width: 100%;
        height: auto;
        margin: 0 auto;
        padding: 20px;
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

<div class="container custom-form-container">
    <h1 class="mb-4">Edit Client</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-4">
            <div class="col-12 mb-3">
                <label for="client_type">Client Type</label>
                <select id="client_type" name="client_type" class="form-control" required>
                    <option value="individual" {{ old('client_type', $client->client_type) == 'individual' ? 'selected' : '' }}>Individual</option>
                    <option value="society" {{ old('client_type', $client->client_type) == 'society' ? 'selected' : '' }}>Society</option>
                </select>
                @error('client_type')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="code_client">Client Code</label>
                <input type="text" name="code_client" id="code_client" class="form-control"
                    value="{{ old('code_client', $client->code_client) }}" readonly>
                @error('code_client')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Individual Fields -->
        <div id="individual_fields" class="client-fields" style="{{ $client->client_type == 'individual' ? 'display: block;' : 'display: none;' }}">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name_client">Last Name</label>
                    <input type="text" id="name_client" name="name_client" class="form-control"
                        value="{{ old('name_client', $client->name_client) }}">
                    @error('name_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="prenom_client">First Name</label>
                    <input type="text" id="prenom_client" name="prenom_client" class="form-control"
                        value="{{ old('prenom_client', $client->prenom_client) }}">
                    @error('prenom_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="email_client">Email</label>
                    <input type="email" id="email_client" name="email_client" class="form-control"
                        value="{{ old('email_client', $client->email_client) }}">
                    @error('email_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cin_client">CIN</label>
                    <input type="text" id="cin_client" name="cin_client" class="form-control"
                        value="{{ old('cin_client', $client->cin_client) }}">
                    @error('cin_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="genre_client">Gender</label>
                    <select id="genre_client" name="genre_client" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Homme" {{ old('genre_client', $client->genre_client) == 'Homme' ? 'selected' : '' }}>Male</option>
                        <option value="Femme" {{ old('genre_client', $client->genre_client) == 'Femme' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('genre_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="sector_of_work_client">Work Sector</label>
                    <input type="text" id="sector_of_work_client" name="sector_of_work_client" class="form-control"
                        value="{{ old('sector_of_work_client', $client->sector_of_work_client) }}">
                    @error('sector_of_work_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="date_of_birth_client">Date of Birth</label>
                    <input type="date" id="date_of_birth_client" name="date_of_birth_client" class="form-control"
                        value="{{ old('date_of_birth_client', $client->date_of_birth_client) }}">
                    @error('date_of_birth_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="registration_datetime_client">Registration Date and Time</label>
                    <input type="datetime-local" id="registration_datetime_client" name="registration_datetime_client" class="form-control"
                        value="{{ old('registration_datetime_client', $client->registration_datetime_client) }}">
                    @error('registration_datetime_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="telephone_client">Phone</label>
                    <input type="text" name="telephone_client" id="telephone_client" class="form-control"
                        value="{{ old('telephone_client', $client->telephone_client) }}">
                    @error('telephone_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="city_client">Secondary Phone</label>
                    <input type="text" name="secondary_telephone_client" id="secondary_telephone_client" class="form-control"
                        value="{{ old('secondary_telephone_client', $client->secondary_telephone_client) }}">
                    @error('secondary_telephone_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="address_client">Address</label>
                    <input type="text" name="address_client" id="address_client" placeholder="Street address, P.O. Box, etc." class="form-control"
                        value="{{ old('address_client', $client->address_client) }}">
                    @error('address_client')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="address_client2">Address 2</label>
                    <input type="text" name="address_client2" id="address_client2" placeholder="Apartment, suite, unit, etc." class="form-control"
                        value="{{ old('address_client2', $client->address_client2) }}">
                    @error('address_client2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Society Fields -->
        <div id="enterprise_fields" class="client-fields" style="{{ $client->client_type == 'society' ? 'display: block;' : 'display: none;' }}">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="society_type">Society Type</label>
                    <select id="society_type" name="society_type" class="form-control">
                        <option value="">Select Society Type</option>
                        <option value="company" {{ old('society_type', $client->society_type) == 'company' ? 'selected' : '' }}>Company</option>
                        <option value="enterprise" {{ old('society_type', $client->society_type) == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                        <option value="foundation" {{ old('society_type', $client->society_type) == 'foundation' ? 'selected' : '' }}>Foundation</option>
                        <option value="association" {{ old('society_type', $client->society_type) == 'association' ? 'selected' : '' }}>Association</option>
                        <option value="coporation" {{ old('society_type', $client->society_type) == 'coporation' ? 'selected' : '' }}>Coporation</option>
                        <option value="gov foundation" {{ old('society_type', $client->society_type) == 'gov foundation' ? 'selected' : '' }}>Gov Foundation</option>
                    </select>
                    @error('society_type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="enterprise_name">Society Name</label>
                    <input type="text" id="enterprise_name" name="enterprise_name" class="form-control" placeholder="Enter Society Name" value="{{ old('enterprise_name', $client->enterprise_name) }}">
                    @error('enterprise_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="ice_enterprise">ICE</label>
                    <input type="text" id="ice_enterprise" name="ice_enterprise" class="form-control" placeholder="Enter ICE" value="{{ old('ice_enterprise', $client->ice_enterprise) }}">
                    @error('ice_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="telephone_enterprise">Phone</label>
                    <input type="text" id="telephone_enterprise" name="telephone_enterprise" class="form-control" placeholder="Enter Phone" value="{{ old('telephone_enterprise', $client->telephone_enterprise) }}">
                    @error('telephone_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="secondary_telephone_enterprise">Secondary Phone</label>
                    <input type="text" id="secondary_telephone_enterprise" name="secondary_telephone_enterprise" class="form-control" placeholder="Enter Secondary Phone" value="{{ old('secondary_telephone_enterprise', $client->secondary_telephone_enterprise) }}">
                    @error('secondary_telephone_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="address_enterprise">Address Line 1</label>
                    <input type="text" id="address_enterprise" name="address_enterprise" class="form-control" placeholder="Street address, P.O. Box, etc." value="{{ old('address_enterprise', $client->address_enterprise) }}">
                    @error('address_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="address_enterprise2">Address Line 2</label>
                    <input type="text" id="address_enterprise2" name="address_enterprise2" class="form-control" placeholder="Apartment, suite, unit, etc." value="{{ old('address_enterprise2', $client->address_enterprise2) }}">
                    @error('address_enterprise2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="legal_representative_name_enterprise">Legal Representative Last Name</label>
                    <input type="text" id="legal_representative_name_enterprise" name="legal_representative_name_enterprise" class="form-control" placeholder="Enter Legal Representative Last Name" value="{{ old('legal_representative_name_enterprise', $client->legal_representative_name_enterprise) }}">
                    @error('legal_representative_name_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="legal_representative_prenom_enterprise">Legal Representative First Name</label>
                    <input type="text" id="legal_representative_prenom_enterprise" name="legal_representative_prenom_enterprise" class="form-control" placeholder="Enter Legal Representative First Name" value="{{ old('legal_representative_prenom_enterprise', $client->legal_representative_prenom_enterprise) }}">
                    @error('legal_representative_prenom_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="legal_representative_cin_enterprise">Legal Representative CIN</label>
                    <input type="text" id="legal_representative_cin_enterprise" name="legal_representative_cin_enterprise" class="form-control" placeholder="Enter Legal Representative CIN" value="{{ old('legal_representative_cin_enterprise', $client->legal_representative_cin_enterprise) }}">
                    @error('legal_representative_cin_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="legal_representative_email_enterprise">Legal Representative Email</label>
                    <input type="email" id="legal_representative_email_enterprise" name="legal_representative_email_enterprise" class="form-control" placeholder="Enter Legal Representative Email" value="{{ old('legal_representative_email_enterprise', $client->legal_representative_email_enterprise) }}">
                    @error('legal_representative_email_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="legal_representative_nationality_enterprise">Enterprise Nationality</label>
                    <select id="country" name="legal_representative_nationality_enterprise" class="form-control">
                        <option value="">Select Nationality</option>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                    @error('legal_representative_nationality_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="legal_representative_position_enterprise">Legal Representative Position</label>
                    <input type="text" id="legal_representative_position_enterprise" name="legal_representative_position_enterprise" class="form-control" placeholder="Enter Legal Representative Position" value="{{ old('legal_representative_position_enterprise', $client->legal_representative_position_enterprise) }}">
                    @error('legal_representative_position_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="tax_identification_number_enterprise">Tax Identification Number</label>
                    <input type="text" id="tax_identification_number_enterprise" name="tax_identification_number_enterprise" class="form-control" placeholder="Enter Tax Identification Number" value="{{ old('tax_identification_number_enterprise', $client->tax_identification_number_enterprise) }}">
                    @error('tax_identification_number_enterprise')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="enterprise_sector">Business Sector</label>
                    <input type="text" id="enterprise_sector" name="enterprise_sector" class="form-control" placeholder="Enter Business Sector" value="{{ old('enterprise_sector', $client->enterprise_sector) }}">
                    @error('enterprise_sector')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-start mt-4">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
            <a href="{{ route('clients.index') }}" class="btn btn-danger"><i class="fas fa-times-circle"></i> Cancel</a>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clientTypeSelect = document.getElementById('client_type');
        const individualFields = document.getElementById('individual_fields');
        const enterpriseFields = document.getElementById('enterprise_fields');

        clientTypeSelect.addEventListener('change', function () {
            if (clientTypeSelect.value === 'individual') {
                individualFields.style.display = 'block';
                enterpriseFields.style.display = 'none';
            } else if (clientTypeSelect.value === 'society') {
                individualFields.style.display = 'none';
                enterpriseFields.style.display = 'block';
            }
        });

        if (clientTypeSelect.value === 'individual') {
            individualFields.style.display = 'block';
            enterpriseFields.style.display = 'none';
        } else if (clientTypeSelect.value === 'society') {
            individualFields.style.display = 'none';
            enterpriseFields.style.display = 'block';
        }
    });
</script>
<script>
    const countries = [
            "Morocco",
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina",
            "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
            "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina",
            "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde",
            "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China",
            "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus",
            "Czechia (Czech Republic)", "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica",
            "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
            "Eswatini (fmr. Swaziland)", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia",
            "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti",
            "Holy See", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel",
            "Italy", "Ivory Coast", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait",
            "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania",
            "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
            "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro",
            "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru", "Nepal", "Netherlands",
            "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman",
            "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
            "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
            "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
            "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands",
            "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname",
            "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste",
            "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda",
            "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay",
            "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
        ];
    const countrySelect = document.getElementById('country');

    const selectedCountry = "{{ old('legal_representative_nationality_enterprise', $client->legal_representative_nationality_enterprise) }}";

countries.forEach(country => {
    const option = document.createElement('option');
    option.value = country;
    option.textContent = country;

    if (country === selectedCountry) {
        option.selected = true;
    }

    countrySelect.appendChild(option);
});
</script>
@endsection
