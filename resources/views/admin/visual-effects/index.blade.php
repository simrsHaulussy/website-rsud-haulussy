@extends('admin.layout.main')

@section('title', 'Pengaturan Efek Visual')

@section('link')
    <link href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet">
    <style>
        /* =============================================
           Visual Effects Settings - Admin Page Styles
           ============================================= */

        /* Card Layout */
        .visual-effects-card {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            border: none;
            overflow: hidden;
        }

        .visual-effects-card .card-header {
            background: linear-gradient(to right, #4299e1, #7f9cf5);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            border: none;
        }

        .visual-effects-card .card-header .header-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .visual-effects-card .card-body {
            padding: 25px;
            background-color: #fff;
        }

        /* Effect Section */
        .effect-section {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }

        .effect-section:last-of-type {
            margin-bottom: 0;
        }

        .effect-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
        }

        .effect-section-header .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            font-weight: 600;
            color: #2d3748;
            font-size: 1.1rem;
        }

        .effect-section-header .section-badge {
            background: linear-gradient(to right, #3182ce, #4299e1);
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .effect-section-header .material-icons-round {
            font-size: 22px;
        }

        .effect-section-header.snowfall .material-icons-round {
            color: #3182ce;
        }

        .effect-section-header.particles .material-icons-round {
            color: #4299e1;
        }

        /* Form Controls */
        .visual-effects-form .form-group {
            margin-bottom: 20px;
        }

        .visual-effects-form label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .visual-effects-form .form-text {
            color: #718096;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .visual-effects-form .form-text .material-icons-round {
            font-size: 16px;
            vertical-align: middle;
            margin-right: 4px;
        }

        /* Toggle Switch */
        .toggle-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .toggle-wrapper .switch-group {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .toggle-wrapper .switch-group .custom-control {
            flex-shrink: 0;
        }

        .toggle-wrapper .switch-group .label-text {
            font-weight: 500;
            color: #2d3748;
            font-size: 0.95rem;
        }

        .toggle-status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            flex-shrink: 0;
            white-space: nowrap;
        }

        .toggle-status-badge.active {
            background-color: #c6f6d5;
            color: #22543d;
        }

        .toggle-status-badge.inactive {
            background-color: #fed7d7;
            color: #742a2a;
        }

        /* Toggle Switch */
        .visual-effects-form .custom-control.custom-switch {
            padding-left: 0;
            margin-bottom: 0;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-input {
            width: 44px;
            height: 24px;
            left: 0;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-label {
            padding-left: 52px;
            line-height: 24px;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-label::before {
            width: 44px;
            height: 24px;
            border-radius: 12px;
            background-color: #cbd5e0;
            border: none;
            left: 0;
            top: 0;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-label::after {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: white;
            top: 3px;
            left: 3px;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #4299e1;
        }

        .visual-effects-form .custom-control.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
            transform: translateX(20px);
        }

        /* Range Input */
        .range-wrapper {
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .range-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .range-label {
            color: #718096;
            font-size: 0.875rem;
        }

        .range-value {
            padding: 5px 14px;
            background: linear-gradient(to right, #3182ce, #4299e1);
            color: white;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .visual-effects-form .custom-range {
            height: 6px;
            border-radius: 3px;
            background: #e2e8f0;
            width: 100%;
        }

        .visual-effects-form .custom-range::-webkit-slider-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(to right, #3182ce, #4299e1);
            cursor: pointer;
            -webkit-appearance: none;
        }

        .visual-effects-form .custom-range::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(to right, #3182ce, #4299e1);
            cursor: pointer;
            border: none;
        }

        /* Month Selection */
        .months-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .month-checkbox-item {
            position: relative;
        }

        .month-checkbox-item .custom-control {
            position: static;
            padding-left: 28px;
            margin: 0;
            min-height: auto;
            display: block;
        }

        .month-checkbox-item .custom-control-input {
            position: absolute;
            width: 18px;
            height: 18px;
            left: 0;
            top: 0;
            margin: 0;
            z-index: 1;
        }

        .month-checkbox-item .custom-control-label {
            display: block;
            width: 100%;
            padding-left: 28px;
            margin-bottom: 0;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4a5568;
            line-height: 18px;
            min-height: 18px;
            cursor: pointer;
        }

        .month-checkbox-item .custom-control-label::before {
            position: absolute;
            width: 18px;
            height: 18px;
            left: 0;
            top: 0;
            border-radius: 4px;
            background-color: #fff;
            border: 2px solid #cbd5e0;
            pointer-events: none;
        }

        .month-checkbox-item .custom-control-label::after {
            position: absolute;
            width: 10px;
            height: 10px;
            left: 4px;
            top: 4px;
            border-radius: 2px;
            background-color: #fff;
            transform: scale(0);
            transition: transform 0.2s ease-in-out;
            pointer-events: none;
        }

        .month-checkbox-item .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #4299e1;
            border-color: #4299e1;
        }

        .month-checkbox-item .custom-control-input:checked ~ .custom-control-label::after {
            transform: scale(1);
        }

        .month-checkbox-item .custom-control-input:focus ~ .custom-control-label::before {
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.25);
        }

        #snowfall_months_hidden {
            display: none;
        }

        .selected-months-display {
            margin-top: 12px;
            padding: 10px 14px;
            background: #f0f9ff;
            border-radius: 6px;
            border: 1px solid #bae6fd;
            font-size: 0.85rem;
            color: #0369a1;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .selected-months-display .material-icons-round {
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Input Fields */
        .visual-effects-form .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .visual-effects-form .form-control:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }

        /* Alert */
        .visual-effects-alert {
            border-radius: 8px;
            border: none;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        .visual-effects-alert.alert-success {
            background-color: #c6f6d5;
            color: #22543d;
        }

        /* Buttons */
        .visual-effects-footer {
            padding: 18px 25px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            gap: 12px;
        }

        .btn-save-settings {
            background: linear-gradient(to right, #3182ce, #4299e1);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(49, 130, 206, 0.2);
        }

        .btn-save-settings:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(49, 130, 206, 0.25);
            color: white;
        }

        .btn-cancel-settings {
            background-color: #edf2f7;
            color: #4a5568;
            border: 1px solid #e2e8f0;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-cancel-settings:hover {
            background-color: #e2e8f0;
            color: #2d3748;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('visual-effects.update') }}" method="POST" class="visual-effects-form">
                    @csrf

                    <div class="card visual-effects-card">
                        <div class="card-header">
                            <div class="header-content">
                                <i class="material-icons-round">auto_awesome</i>
                                <span>Pengaturan Efek Visual</span>
                            </div>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible visual-effects-alert">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <i class="material-icons-round" style="vertical-align: middle; font-size: 18px; margin-right: 6px;">check_circle</i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Snowfall Configuration -->
                            <div class="effect-section">
                                <div class="effect-section-header snowfall">
                                    <h5 class="section-title">
                                        <i class="material-icons-round">ac_unit</i>
                                        <span>Snowfall Effect</span>
                                    </h5>
                                    <span class="section-badge">Christmas Season</span>
                                </div>

                                <div class="form-group">
                                    <div class="toggle-wrapper">
                                        <div class="switch-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="snowfall_enabled" name="snowfall_enabled" value="1" data-target="snowfall-status" {{ ($settings['snowfall_enabled'] ?? '1') == '1' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="snowfall_enabled"></label>
                                            </div>
                                            <span class="label-text">Aktifkan Efek Snowfall</span>
                                        </div>
                                        <span class="toggle-status-badge {{ ($settings['snowfall_enabled'] ?? '1') == '1' ? 'active' : 'inactive' }}" id="snowfall-status">
                                            {{ ($settings['snowfall_enabled'] ?? '1') == '1' ? 'AKTIF' : 'NONAKTIF' }}
                                        </span>
                                    </div>
                                    <small class="form-text"><i class="material-icons-round">info</i> Efek salju yang jatuh dengan animasi halus</small>
                                </div>

                                <div class="form-group">
                                    <label>Jumlah Snowflakes Maksimum</label>
                                    <div class="range-wrapper">
                                        <div class="range-header">
                                            <span class="range-label">Kepadatan efek</span>
                                            <span class="range-value" id="snowflakes-value">{{ $settings['max_snowflakes'] ?? 50 }}</span>
                                        </div>
                                        <input type="range" class="custom-range form-control" id="max_snowflakes" name="max_snowflakes" min="20" max="100" step="5" value="{{ $settings['max_snowflakes'] ?? 50 }}">
                                    </div>
                                    <small class="form-text"><i class="material-icons-round">tune</i> Rentang: 20 (ringan) - 100 (penuh)</small>
                                </div>

                                <div class="form-group">
                                    <label>Bulan Aktif</label>
                                    <div class="months-grid">
                                        @php
                                            $selectedMonths = array_map('intval', explode(',', $settings['snowfall_months'] ?? '11,12,1'));
                                            $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
                                        @endphp
                                        @foreach($months as $monthNum => $monthName)
                                            <div class="month-checkbox-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input month-checkbox" id="month_{{ $monthNum }}" value="{{ $monthNum }}" {{ in_array($monthNum, $selectedMonths) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="month_{{ $monthNum }}">{{ $monthName }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" id="snowfall_months_hidden" name="snowfall_months" value="{{ $settings['snowfall_months'] ?? '11,12,1' }}">
                                    <div class="selected-months-display">
                                        <i class="material-icons-round">check_circle</i>
                                        <span id="selected-months-text">{{ implode(', ', array_intersect_key($months, array_flip($selectedMonths))) }}</span>
                                    </div>
                                    <small class="form-text"><i class="material-icons-round">calendar_today</i> Pilih bulan untuk aktivasi otomatis</small>
                                </div>
                            </div>

                            <!-- Particle Configuration -->
                            <div class="effect-section">
                                <div class="effect-section-header particles">
                                    <h5 class="section-title">
                                        <i class="material-icons-round">bubble_chart</i>
                                        <span>Blue Particle Effect</span>
                                    </h5>
                                    <span class="section-badge">Hero Animation</span>
                                </div>

                                <div class="form-group">
                                    <div class="toggle-wrapper">
                                        <div class="switch-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="particles_enabled" name="particles_enabled" value="1" data-target="particles-status" {{ ($settings['particles_enabled'] ?? '1') == '1' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="particles_enabled"></label>
                                            </div>
                                            <span class="label-text">Aktifkan Efek Partikel Biru</span>
                                        </div>
                                        <span class="toggle-status-badge {{ ($settings['particles_enabled'] ?? '1') == '1' ? 'active' : 'inactive' }}" id="particles-status">
                                            {{ ($settings['particles_enabled'] ?? '1') == '1' ? 'AKTIF' : 'NONAKTIF' }}
                                        </span>
                                    </div>
                                    <small class="form-text"><i class="material-icons-round">info</i> Animasi partikel biru interaktif di hero section</small>
                                </div>

                                <div class="form-group">
                                    <label for="particles_color">Warna Partikel</label>
                                    <input type="text" id="particles_color" name="particles_color" class="form-control" value="{{ $settings['particles_color'] ?? '#3db4e1' }}" placeholder="#3db4e1">
                                    <small class="form-text"><i class="material-icons-round">palette</i> Klik input untuk memilih warna</small>
                                </div>

                                <div class="form-group">
                                    <label>Jumlah Partikel</label>
                                    <div class="range-wrapper">
                                        <div class="range-header">
                                            <span class="range-label">Kepadatan partikel</span>
                                            <span class="range-value" id="particles-value">{{ $settings['particles_count'] ?? 8 }}</span>
                                        </div>
                                        <input type="range" class="custom-range form-control" id="particles_count" name="particles_count" min="1" max="20" step="1" value="{{ $settings['particles_count'] ?? 8 }}">
                                    </div>
                                    <small class="form-text"><i class="material-icons-round">tune</i> Rentang: 1 (minimal) - 20 (maksimal)</small>
                                </div>
                            </div>
                        </div>

                        <div class="visual-effects-footer">
                            <button type="submit" class="btn-save-settings">
                                <i class="material-icons-round">save</i>
                                Simpan Pengaturan
                            </button>
                            <a href="{{ url('/dashboard') }}" class="btn-cancel-settings">
                                <i class="material-icons-round">close</i>
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Month selection data
            const monthNames = {1:'Januari',2:'Februari',3:'Maret',4:'April',5:'Mei',6:'Juni',7:'Juli',8:'Agustus',9:'September',10:'Oktober',11:'November',12:'Desember'};

            // Update selected months display text
            function updateSelectedMonthsDisplay() {
                const checkedBoxes = document.querySelectorAll('.month-checkbox:checked');
                const selectedValues = Array.from(checkedBoxes).map(cb => cb.value).sort((a, b) => a - b);
                document.getElementById('snowfall_months_hidden').value = selectedValues.join(',');
                const displayElement = document.getElementById('selected-months-text');
                if (selectedValues.length === 0) {
                    displayElement.textContent = 'Tidak ada bulan yang dipilih';
                } else if (selectedValues.length === 12) {
                    displayElement.textContent = 'Sepanjang Tahun';
                } else {
                    displayElement.textContent = selectedValues.map(v => monthNames[v]).join(', ');
                }
            }

            // Initialize month checkbox handlers
            document.querySelectorAll('.month-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', updateSelectedMonthsDisplay);
            });
            updateSelectedMonthsDisplay();

            // Initialize Spectrum Color Picker
            $('#particles_color').spectrum({
                type: 'color', showInput: true, showPalette: true, showSelectionPalette: true,
                maxSelectionSize: 10, preferredFormat: 'hex',
                palette: [['#3db4e1', '#007bff', '#17a2b8', '#00bcd4', '#4fc3f7'], ['#6610f2', '#6f42c1', '#e83e8c', '#fd7e14', '#ffc107']]
            });

            // Range slider handlers
            const snowflakesSlider = document.getElementById('max_snowflakes');
            const snowflakesValue = document.getElementById('snowflakes-value');
            if (snowflakesSlider && snowflakesValue) {
                snowflakesSlider.addEventListener('input', function() { snowflakesValue.textContent = this.value; });
            }

            const particlesSlider = document.getElementById('particles_count');
            const particlesValue = document.getElementById('particles-value');
            if (particlesSlider && particlesValue) {
                particlesSlider.addEventListener('input', function() { particlesValue.textContent = this.value; });
            }

            // Toggle badge status updates
            document.querySelectorAll('[data-target]').forEach(function(checkbox) {
                const updateBadge = function() {
                    const badge = document.getElementById(checkbox.getAttribute('data-target'));
                    if (badge) {
                        badge.className = 'toggle-status-badge ' + (checkbox.checked ? 'active' : 'inactive');
                        badge.textContent = checkbox.checked ? 'AKTIF' : 'NONAKTIF';
                    }
                };
                updateBadge();
                checkbox.addEventListener('change', updateBadge);
            });
        });
    </script>
@endsection
