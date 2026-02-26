@extends('visitor.layout.main')

@section('title', 'Direksi & Manajemen')

@section('style')
    <style>
        .custom-card {
            margin-bottom: 20px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
            transition: all 0.6s ease;
        }

        .custom-card:hover {
            box-shadow: rgba(150, 204, 223, 0.199) -10px 10px, rgba(150, 204, 223, 0.19) -20px 20px;
        }
    </style>
@endsection

@section('content')
    <div class="text-center mb-5">
        <h1>Direksi dan Manajemen</h1>
    </div>
    <div class="mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Direktur</h3>
                        <img src="{{ asset('visitor/assets/img/gallery/direk_winny_bg.png') }}" class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">dr. Winny Natacia Leiwakabessy, Sp.PA, M.Kes</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Sekretaris</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Fatum Pulhehe, SE, M.Si.</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Subkoordinator <span><br>Umum dan Humas</span></h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Julia Nancy de Queljoe, S.K.M</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Subkoordinator <span><br>Kepegawaian</span> </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Janiba Marasabessy, S.K.M</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-10 col-md-7 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Wakil Direktur <span><br> Pelayanan & Keperawatan</span>
                        </h3>
                        <img src="{{ asset('visitor/assets/img/dokter/spesialis/dr. Enseline Nikijuluw, Sp.N.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">dr. Enseline Nikijuluw, Sp.N.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-7 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Wakil Direktur <span><br> Penunjang Medis</span></h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">dr. Rosdiana Perau, M.Kes.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-7 col-lg-4">
                    <div class="card custom-card">
                        <h3 class="card-title text-center pt-3">Wakil Direktur <span><br>Program & Keuangan</span></h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Bernadetta Rosianti, S.K.M, M.Kes.</h5>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Pelayanan </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Hadijah Latuconsina, S.Kep Ns, M.Kep.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Keperawatan </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Sri Rohani Mony, S.K.M, M.Kes.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Pendidikan,
                            Penelitian dan Akreditasi </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Dan Tandi, S.Kep., Ns., M.Kep.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Penunjang
                            Diagnostik dan Logistik </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}" class="card-img-top"
                            alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">dr. Iznih R. M. Sahib</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Program </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Fatmawaty Tatuhey, Apt. S.Si.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Kepala Bidang <br> Keuangan </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Rio Talama, S.E., Ak. M.Si. CA.</h5>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3 ">Subkoordinator <br> Pelayanan Medis
                        </h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">dr. Inggrid Sihasale</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Pengendalian Mutu
                            Pelayanan</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Meggy Roselin Oktavia Tuhumena, S.kep., Ns.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Bimbingan Asuhan
                            dan Pelayanan Keperawatan</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Fera Y. Pattikawa, S.Kep., Ns., M.Kep.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Bimbingan Mutu
                            dan Etika Keperawatan</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Mariyana Katjong, S.Kep., Ns.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Pendidikan dan
                            Penelitian</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Zakaria N. Elwuar, S.Pd., M.H.Kes</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Akreditasi</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Daniel Dady, S.Kep., Ns., M.Kep.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Penunjang
                            Diagnostik</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Israelly S. Tetelepta, S.ST.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Penunjang
                            Logistik</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_laki_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Hengky Birahy, S.K.M.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Penyusunan
                            Program</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Julia S. Rehatta, S.K.M.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Monitoring,
                            Evaluasi dan Pelaporan</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Debbye Ch. Huliselan, SE, M.Si.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Perbendaharaan
                            dan Mobilisasi Dana</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Dewi Wati Rakib, S.Sos., M.Si.</h5>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-sm-10 col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <h3 style="height: 120px" class="card-title text-center pt-3">Subkoordinator <br>Verifikasi dan
                            Akutansi</h3>
                        <img src="{{ asset('visitor/assets/img/avatar/avatar_cewe_background.png') }}"
                            class="card-img-top" alt="IGD">
                        <div class="card-body">
                            <h5 class="card-text text-secondary text-center">Marya Mustamu, SE, M.Si.</h5>
                        </div>
                    </div>
                </div>
                <p class="text-danger text-right">
                    <b>*Diperbarui 21 Oktober 2025</b>
                </p>
            </div>
        </div>

    </div>
@endsection
