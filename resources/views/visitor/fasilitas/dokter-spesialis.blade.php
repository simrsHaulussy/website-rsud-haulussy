@extends('visitor.layout.main')

@section('title', 'Dokter Spesialis')

@section('style')
    <style>
        .accordion {
            margin-bottom: 10px;
            width: 100%;
            cursor: pointer;
            text-align: left;
            border: 1px solid #ddd;
            outline: none;
            transition: 0.4s;
            height: 75px;
        }

        .panel {
            display: none;
            padding: 0 18px;
            background-color: white;
            overflow: hidden;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        #doctor-image {
            max-width: 100%;
            max-height: 300px;

        }
    </style>
@endsection

@section('content')
    <div class="text-center mb-5">
        <h1>Dokter Spesialis</h1>
    </div>

    <div class="bg-holder bg-size"
        style="background-image:url(/visitor/assets/img/gallery/about-bg.png);background-position:top center;background-size:contain;">
    </div>

    <div class="container">
        <p class="text-danger">
            <b>*Diperbarui 02 Juni 2025</b>
        </p>
        <div class="row justify-content-center">
            <!-- Daftar dokter dengan Bootstrap grid -->
            <div class="col-md-6 col-sm-12 col-12">
                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterOO')">dr. Achmad Tuahuns,
                    Sp.B
                </button>
                <div class="panel" id="DokterOO">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter OO"
                        id="doctor-image" />
                </div> --}}

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterBB')">dr. Adelin Saulinggi, Sp.KJ
                </button>
                <div class="panel" id="DokterBB">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter BB"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterBB')">dr. Astri
                    Sangadji, Sp.Rad
                </button>
                <div class="panel" id="DokterBB">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter BB"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterFF')">Dr. dr. Bertha
                    Jean Que, Sp.S, M.Kes.
                </button>
                <div class="panel" id="DokterFF">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter FF"
                        id="doctor-image" />
                </div>


                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterH')">dr. Costantius
                    William Sialana, Sp.F, M.Kes
                </button>
                <div class="panel" id="DokterH">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Costantius William Sialana, Sp.F, M.Kes.png') }}"
                        alt="Foto Dokter H" id="doctor-image" />
                </div> --}}


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterL')">dr. Denny Jolanda,
                    Sp.PD, FINASIM
                </button>
                <div class="panel" id="DokterL">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter L"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterG')">dr. Elna Sitourisme
                    Anakotta, Sp.M
                </button>
                <div class="panel" id="DokterG">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter G"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterX')">dr. Enseline
                    Nikijuluw, Sp.N
                </button>
                <div class="panel" id="DokterX">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Enseline Nikijuluw, Sp.N.png') }}"
                        alt="Foto Dokter X" id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterMM')">dr. Fahmi
                    Maruapey, Sp.An
                </button>
                <div class="panel" id="DokterMM">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter MM"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterZ')">dr. Firensca
                    Pattiasina, Sp.PK
                </button>
                <div class="panel" id="DokterZ">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Firensca Pattiasina, Sp.PK.png') }}"
                        alt="Foto Dokter Z" id="doctor-image" />
                </div>


                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterKK')">dr. Fitri Kadarsih
                    Bandjar, Sp.KK
                </button>
                <div class="panel" id="DokterKK">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter KK"
                        id="doctor-image" />
                </div> --}}

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterMM')">dr. Gery Soemara, Sp.JP
                </button>
                <div class="panel" id="DokterMM">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter MM"
                        id="doctor-image" />
                </div>

                {{-- dr gracia --}}
                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterSSSS')">
                    dr. Gracia Lilihata, Sp.JP
                </button>
                <div class="panel" id="DokterSSSS">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter KK"
                        id="doctor-image" />
                </div> --}}


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterHH')">dr. Halidah
                    Rahawarin, M.Kes., Sp.PA
                </button>
                <div class="panel" id="DokterHH">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter HH"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterK')">dr. Hanny Tanasal,
                    Sp.KK
                </button>
                <div class="panel" id="DokterK">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter K"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterPP')">drg. Hasrul
                    Husain, Sp.PM
                </button>
                <div class="panel" id="DokterPP">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/drg. Hasrul Husain, Sp.PM.png') }}"
                        alt="Foto Dokter PP" id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterA')">dr. Helfi
                    Nikijuluw, Sp.B KBD
                </button>
                <div class="panel" id="DokterA">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Helfy Nikijuluw, Sp.B KBD.png') }}"
                        alt="Foto Dokter A" id="doctor-image" />
                </div>

                {{-- dr iman --}}
                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterDD')">dr. Iman
                    Haryana, Sp.JP
                </button>
                <div class="panel" id="DokterDD">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Iman Haryana, Sp.JP.png') }}"
                        alt="Foto Dokter DD" id="doctor-image" />
                </div> --}}


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterF')">dr. Ingrid
                    Angeline Hutagalung, Sp.PK, M.Kes
                </button>
                <div class="panel" id="DokterF">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Ingrid Angeline Hutagalung, Sp.PK, M.Kes.png') }}"
                        alt="Foto Dokter F" id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterW')">dr. Irene Leha,
                    Sp.OG
                </button>
                <div class="panel" id="DokterW">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter W"
                        id="doctor-image" />
                </div>


                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterJ')">dr. Isabela
                    Huliselan, Sp.FK
                </button>
                <div class="panel" id="DokterJ">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter J"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterGGG')">dr. Jacky
                    Tuamelly, Sp.B (K) Trauma, FICS, FINACS, FIHFAA
                </button>
                <div class="panel" id="DokterGGG">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Jacky Tuamelly, Sp.B (K) Trauma, FICS, FINACS, FIHFAA.png') }}"
                        alt="Foto Dokter G" id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterN')">dr. Janne
                    Pattiasina, Sp.OG
                </button>
                <div class="panel" id="DokterN">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter N"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterCC')">dr. Jilientasia
                    Godrace Lilihata, Sp.An
                </button>
                <div class="panel" id="DokterCC">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter CC"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterNN')">dr. Julu Manalu,
                    Sp.THT
                </button>
                <div class="panel" id="DokterNN">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter NN"
                        id="doctor-image" />
                </div>


            </div>

            <!-- kanan -->
            <div class="col-12 col-sm-12 col-md-6">
                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterZZZ')">drg. Lina
                    Mardiana, M.KG
                </button>
                <div class="panel" id="DokterZZZ">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter F"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterR')">dr. Marisa
                    Afifudin, Sp.P
                </button>
                <div class="panel" id="DokterR">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter R"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterU')">dr. Masayu
                    Ramadhani Polanunu, Sp.A
                </button>
                <div class="panel" id="DokterU">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter U"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterE')">dr. Maureen J.
                    Paliyama, Sp.KFR
                </button>
                <div class="panel" id="DokterE">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Maureen J. Paliyama, Sp.KFR.png') }}"
                        alt="Foto Dokter E" id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterEE')">dr. Ninoy
                    Mailoa, Sp.B Subspe.BVE(K)
                </button>
                <div class="panel" id="DokterEE">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Ninoy Mailoa, Sp.b Subspe.BVE(K).png') }}"
                        alt="Foto Dokter EE" id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterT')">dr. Novy Riyanti,
                    Sp.OG
                </button>
                <div class="panel" id="DokterT">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter T"
                        id="doctor-image" />
                </div>

                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterGG')">dr. Ony
                    Wibriyono Angkejaya, Sp.An., M.Kes.
                </button>
                <div class="panel" id="DokterGG">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Ony Wibriyono Angkejaya, Sp.An., M.Kes..png') }}"
                        alt="Foto Dokter GG" id="doctor-image" />
                </div> --}}

                {{-- dr yosi sudah mengundurkan diri sejak bulan juni 2026 --}}
                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterII')">dr. Parningotan
                    Yosi Silalahi, Sp.S.
                </button> --}}

                <div class="panel" id="DokterII">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter II"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterAAA')">
                    dr. Pelpina Bormassa, Sp.MK
                </button>
                <div class="panel" id="DokterAAA">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter II"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterBBB')">
                    dr. Prajayanti Palulun, SpMK
                </button>
                <div class="panel" id="DokterBBB">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter II"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterS')">dr. Rita Sugiono
                    Tanamal, Sp.KK
                </button>
                <div class="panel" id="DokterS">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter S"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterC')">dr. Robby Kalew,
                    Sp.A
                </button>
                <div class="panel" id="DokterC">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Robby Kalew, Sp.A.png') }}"
                        alt="Foto Dokter C" id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterQ')">dr. Semuel
                    Alexander Wagiu, Sp.N
                </button>
                <div class="panel" id="DokterQ">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter Q"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterCCC')">
                    dr. Serlly Wattimury, Sp.Rad.
                </button>
                <div class="panel" id="DokterCCC">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter Q"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterV')">dr. Siti Hadjar,
                    Sp.PD
                </button>
                <div class="panel" id="DokterV">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter V"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterLL')">dr. Sri Wahyuni,
                    Sp.A
                </button>
                <div class="panel" id="DokterLL">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter LL"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterO')">dr. Susan
                    Timisela, Sp.PD
                </button>
                <div class="panel" id="DokterO">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter O"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterI')">drg. Suzanna Leuhery,
                    Sp.KG
                </button>
                <div class="panel" id="DokterI">
                    <img src="{{ asset('visitor/assets/img/dokter/spesialis/drg. Suzanna Leuhery, Sp.KG.png') }}"
                        alt="Foto Dokter I" id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterD')">dr. Vivianty
                    Hartiono, Sp.A
                </button>
                <div class="panel" id="DokterD">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter D"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterM')">dr. Winny Natacia
                    Leiwakabessy, Sp.PA, M.Kes.
                </button>
                <div class="panel" id="DokterM">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter M"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterSSSS')">
                    dr. Wiwin Lestari Selawa, Sp.K.F.R
                </button>
                <div class="panel" id="DokterSSSS">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe.png') }}" alt="Foto Dokter KK"
                        id="doctor-image" />
                </div>

                <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterB')">Dr. dr. Yusuf
                    Huningkor, Sp.PD
                </button>
                <div class="panel" id="DokterB">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter B"
                        id="doctor-image" />
                </div>

                {{-- <button class="accordion btn btn-primary" onclick="toggleDoctorPanel('DokterY')">dr. Yulandri
                    Franeldo Uneputty, Sp.B
                </button>
                <div class="panel" id="DokterY">
                    <img src="{{ asset('visitor/assets/img/avatar/avatar_laki.png') }}" alt="Foto Dokter Y"
                        id="doctor-image" />
                </div> --}}
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        // Fungsi untuk menampilkan atau menyembunyikan panel dokter
        function toggleDoctorPanel(doctorId) {
            var panel = document.getElementById(doctorId);
            panel.style.display = panel.style.display === "block" ? "none" : "block";
        }
    </script>
@endsection
