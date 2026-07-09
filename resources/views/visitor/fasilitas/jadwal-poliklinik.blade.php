@extends('visitor.layout.main')

@section('title', 'Jadwal Poliklinik')

@section('style')
    <style>
        #table {
            z-index: 1;
            background-color: white;
            padding: 0;
        }

        .tb-header {
            background-color: #283779;
            color: white;
        }

        .note {
            font-size: 18px;
        }

        .note-bottom {
            font-size: 18px;
        }
    </style>
@endsection


@section('content')
    <div class="text-center mb-5">
        <h1>Jadwal Poliklinik</h1>
    </div>

    <div class="container" id="table">
        <table class="mb-2">
            <tr>
                <td><p class="note">Mulai Pendaftaran </p></td>
                <td><p class="note">: 08:00 - 11:00.</p></td>
            </tr>
            <tr>
                <td><p class="note">Mulai Pelayanan </p></td>
                <td><p class="note">: 09:00 - 14:00.</p></td>
            </tr>
        </table>

        <table class="table table-striped table-bordered">
            <thead>
                <tr class="tb-header">
                    <th scope="col">No</th>
                    <th scope="col">Nama Klinik</th>
                    <th scope="col">Nama Dokter</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
            {{-- start lantai 1 --}}
                {{-- start Klinik Penyakit Dalam --}}
                <tr>
                    <th scope="row">1</th>
                    <td>Klinik Penyakit Dalam</td>
                    <td>dr. Susan Timisela, Sp.PD</td>
                    <td>Senin</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Denny Yolanda, Sp.PD</td>
                    <td>Selasa</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Yusuf Huningkor, Sp.PD-KKV</td>
                    <td>Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Penyakit Dalam --}}
                {{-- start Klinik Bedah --}}
                <tr>
                    <th scope="row">2</th>
                    <td>Klinik Bedah</td>
                    <td>dr. Jacky Tuamelly, Sp. (K) Trauma, FICS, FINACS, FIHFAA</td>
                    <td>Senin, Selasa, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Bedah --}}
                {{-- start Klinik Bedah Vaskular --}}
                <tr>
                    <th scope="row">3</th>
                    <td>Klinik Bedah Vaskular</td>
                    <td>dr. Ninoy Mailoa, Sp.B, Sub Sp.BVE (K)</td>
                    <td>Selasa, Rabu, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Bedah Vaskular --}}
                {{-- start Klinik Syaraf --}}
                <tr>
                    <th scope="row">4</th>
                    <td>Klinik Syaraf</td>
                    <td>dr. Enseline Nikijuluw, Sp.N</td>
                    <td>Selasa dan Rabu</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Bertha Jean Que, Sp.S, M.Kes.</td>
                    <td>Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Semuel Alexander Wagiu, Sp.N</td>
                    <td>Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Syaraf --}}
                {{-- start Klinik Jiwa --}}
                <tr>
                    <th scope="row">5</th>
                    <td>Klinik Jiwa/Psikiatri</td>
                    <td>dr. Adelin Saulinggi, Sp.KJ (K)</td>
                    <td>Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Jiwa --}}
                {{-- start Klinik Gigi dan Mulut --}}
                <tr>
                    <th scope="row">6</th>
                    <td>Klinik Gigi dan Mulut</td>
                    <td>drg. Suzanna Leuhery, Sp.KG</td>
                    <td>Selasa, Rabu, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>drg. Hasrul Husain, Sp.PM</td>
                    <td>Senin dan Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Gigi dan Mulut --}}
                {{-- start Klinik Asma, DOTS, MDR --}}
                <tr>
                    <th scope="row">7</th>
                    <td>Klinik Asma, DOTS, MDR</td>
                    <td>dr. Marisa Afifudin, Sp.P</td>
                    <td>Selasa dan Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Asma, DOTS, MDR --}}
                {{-- start Klinik Jantung --}}
                <tr>
                    <th scope="row">8</th>
                    <td>Klinik Jantung</td>
                    <td>dr. Gerry Soemara, Sp.JP</td>
                    <td>Selasa, Rabu, Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Jantung --}}
                {{-- start Klinik Kandungan --}}
                <tr>
                    <th scope="row">9</th>
                    <td>Klinik Kandungan</td>
                    <td>dr. Jeane Pattiasina, Sp.OG</td>
                    <td>Senin</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Novy Rianti, Sp.OG, M.Kes</td>
                    <td>Selasa</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Irene Leha, Sp.OG</td>
                    <td>Rabu</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Uli Maricar, Sp.OG</td>
                    <td>Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Kandungan --}}
                {{-- start Klinik Mata --}}
                <tr>
                    <th scope="row">10</th>
                    <td>Klinik Mata</td>
                    <td>dr. Elna Anakotta, Sp.M, SH</td>
                    <td>Senin dan Rabu</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Mata --}}
                {{-- start Klinik Rehabilitasi Medik (Fisioterapi) --}}
                <tr>
                    <th scope="row">11</th>
                    <td>Klinik Rehabilitasi Medik (Fisioterapi)</td>
                    <td>dr. Mauren Palijama, Sp.KFR</td>
                    <td>Senin, Rabu, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Wiwin Lestari Selawa, Sp.KFR</td>
                    <td>Selasa dan Kamis</td>
                    <td>09:00 - selesai</td>
                </tr>
                {{-- end Klinik Rehabilitasi Medik (Fisioterapi) --}}
                {{-- start Klinik Hemodialisis --}}
                <tr>
                    <th scope="row">12</th>
                    <td>Klinik Hemodialisis</td>
                    <td>dr. Siti Hadjar, Sp.PD</td>
                    <td>Selasa dan Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Hemodialisis --}}
                {{-- start Klinik Endoskopi --}}
                <tr>
                    <th scope="row">13</th>
                    <td>Klinik Endoskopi</td>
                    <td>dr. Denny Jolanda, Sp.PD, FINASIM</td>
                    <td>Senin-Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Helfi Nikijuluw, Sp.B-KBD</td>
                    <td>Senin-Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Endoskopi --}}
                {{-- start Klinik MCU --}}
                <tr>
                    <th scope="row">14</th>
                    <td>Klinik MCU</td>
                    <td>dr. Wenny Fonda Liklikwatil</td>
                    <td>Senin - Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik MCU --}}
            {{-- end lantai 1 --}}
            {{-- start lantai 2 --}}
                {{-- start Klinik Kulit Kelamin --}}
                <tr>
                    <th scope="row">15</th>
                    <td>Klinik Kulit Kelamin</td>
                    <td>dr. Hanny Tanasal, Sp.KK</td>
                    <td>Senin-Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Rita Sugiono Tanamal, Sp.KK</td>
                    <td>Senin-Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Kulit Kelamin --}}
                {{-- start Klinik Anak --}}
                <tr>
                    <th scope="row">16</th>
                    <td>Klinik Anak</td>
                    <td>dr. Robby Kalew, Sp.A</td>
                    <td>Selasa</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Vivianty Hartiono, Sp.A., MARS</td>
                    <td>Senin dan Rabu</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Masayu Polanunu, Sp.A</td>
                    <td>Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>Imunisasi</td>
                    <td>Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Anak --}}
                {{-- start Klinik Bedah Digestif --}}
                <tr>
                    <th scope="row">17</th>
                    <td>Klinik Bedah Digestif</td>
                    <td>dr. Helfi Nikijuluw, Sp.B-KBD</td>
                    <td>Selasa, Rabu, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik Bedah Digestif --}}
                {{-- start Klinik THT --}}
                <tr>
                    <th scope="row">18</th>
                    <td>Klinik THT</td>
                    <td>dr. Julu Manalu, Sp.THT-KL</td>
                    <td>Senin, Rabu, Jumat</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik THT --}}
                {{-- start Klinik VCT/CST --}}
                <tr>
                    <th scope="row">19</th>
                    <td>Klinik VCT/CST</td>
                    <td>dr. Denny Jolanda, Sp.PD, FINASIM</td>
                    <td>Selasa dan Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td>dr. Sheila Dewanty Christin Maunuputty</td>
                    <td>Selasa dan Kamis</td>
                    <td>09.00 - selesai</td>
                </tr>
                {{-- end Klinik VCT/CST --}}
            {{-- end lantai 2 --}}
            </tbody>
        </table>
        <p class="text-danger note-bottom"><i>*23 Agustus 2025</i></p>
    </div>
@endsection
