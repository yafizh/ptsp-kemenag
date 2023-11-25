<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPDP</title>
    <style>
        .td-fit {
            width: 1%;
            white-space: nowrap;
        }

        table {
            width: 100%;
        }

        table,
        table tr td {
            border-collapse: collapse;
            border: 1px solid black;
            padding: .4rem;
        }

        table ol {
            padding: 0;
            margin: 0 0 0 1rem;
        }

        main {
            width: 90%;
            /* background-color: red; */
            margin: auto;
        }

        main h3,
        main h4 {
            text-align: center;
        }

        @page {
            size: legal;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>
    <main>
        <div style="display: flex;">
            <div style="padding-top: 8rem; flex:1 1 0px; font-size: 11px;">
                <div>Kementerian Negara/Lembaga: Kementerian Agama</div>
                <div>Sekretariat Jenderal</div>
                <div>Kantor Kementerian Agama Kab Banjar</div>
            </div>
            <div style="display: flex; margin: 0 2rem; justify-content: center;">
                <img src="/assets/images/logos/garuda.jpg" width="85" style="align-self: flex-start;">
            </div>
            <div style="padding-top: 4rem; flex:1 1 0px; font-size: 10px;">
                <div>PERATURAN MENTERI KEUANGAN REPUBLIK INDONESIA</div>
                <div>NOMOR 113 / PMK.05/2012</div>
                <div>TENTANG PERJALANAN DINAS JABATAN DALAM NEGERI BAGI</div>
                <div>PEJABAT NEGARA, PERGAWAI NEGERI DAN PEGAWAI TIDAK TETAP</div>
                <br>
                <div>Lembar Ke:</div>
                <div>Kode No.</div>
                <div>Nomor: B-0715/Kk.17.03-1/Ku.00/SPD/10/2022</div>
            </div>
        </div>
        <h3><u>SURAT PERJALANAN DINAS (SPD)</u></h3>
        <table>
            <tr>
                <td class="td-fit">1.</td>
                <td style="width: 50%;">Pejabat Pembuat Komitmen</td>
                <td colspan="2">{{ $spdp['pembuat_komitmen_nama'] }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Nama / NIP Pegawai yang diperintahkan</td>
                <td colspan="2">{{ $spdp['pegawai_nip'] }}/{{ $spdp['pegawai_nama'] }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>
                    <ol type="a">
                        <li>Pangkat dan Golongan</li>
                        <li>Jabatan / Instansi</li>
                        <li>Tingkat Biaya Perjalanan Dinas</li>
                    </ol>
                </td>
                <td colspan="2">
                    <ol type="a">
                        <li>{{ $spdp['pegawai_pangkat'] }}, {{ $spdp['pegawai_golongan'] }}</li>
                        <li>{{ $spdp['pegawai_jabatan'] }}</li>
                        <li>{{ $spdp['tingkat_biaya_perjalanan_dinas'] }}</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Maksud Perjalanan Dinas</td>
                <td colspan="2">{{ $spdp['maksud_perjalanan_dinas'] }}</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Alat Angkutan yang dipergunakan</td>
                <td colspan="2">{{ $spdp['jenis_kendaraan'] }}</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>
                    <ol type="a">
                        <li>Tempat Berangkat</li>
                        <li>Tempat Tujuan</li>
                    </ol>
                </td>
                <td colspan="2">
                    <ol type="a">
                        <li>{{ $spdp['tempat_berangkat'] }}</li>
                        <li>{{ $spdp['tempat_tujuan'] }}</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>
                    <ol type="a">
                        <li>Lamanya perjalanan dinas</li>
                        <li>Tanggal berangkat</li>
                        <li>Tanggal kembali</li>
                    </ol>
                </td>
                <td colspan="2">
                    <ol type="a">
                        <li>{{ $spdp['lama_perjalanan_dinas'] }} Hari</li>
                        <li>{{ $spdp['tanggal_berangkat'] }}</li>
                        <li>{{ $spdp['tanggal_kembali'] }}</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td rowspan="6">
                    8.
                </td>
                <td style="width: 50%;">Pengikut Nama</td>
                <td style="width: 25%; text-align: center;">NIP</td>
                <td style="width: 25%; text-align: center;">Keterangan</td>
            </tr>
            <tr>
                <td>1.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>5.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>9.</td>
                <td>
                    <label>Pembebanan Anggaran</label>
                    <ol type="a">
                        <li></li>
                        <li></li>
                    </ol>
                </td>
                <td colspan="2">
                    <label style="visibility: hidden;">Pembebanan Anggaran</label>
                    <ol type="a">
                        <li>Kankemeang Kab. Banjar</li>
                        <li>524</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>10.</td>
                <td>Keterangan lain-lain</td>
                <td colspan="2"></td>
            </tr>
        </table>

        <div style="display: flex; justify-content: end; padding: 2rem 4rem;">
            <div>
                <div>
                    <span style="display: inline-block; width: 6rem;">Dikeluarkan di</span>
                    <span>: Martapura</span>
                </div>
                <div>
                    <span style="display: inline-block; width: 6rem;">Tanggal</span>
                    <span>: {{ $spdp['tanggal_verifikasi'] }}</span>
                </div>
                <div>Pejabat Pembuat Komitmen, </div>
                <br><br><br><br>
                <div><strong>{{ $spdp['pembuat_komitmen_nama'] }}</strong></div>
                <div>NIP. {{ $spdp['pembuat_komitmen_nip'] }}</div>
            </div>
        </div>
    </main>

    <div style="page-break-before: always;"></div>

    <main>
        <div style="display: flex; justify-content: center; margin-top: 2rem;">
            <img src="/assets/images/logos/garuda.jpg" width="55">
        </div>
        <h4>
            MENTERI AGAMA
            <br>
            REPUBLIK INDOENSIA
        </h4>

        <table style="font-size: 14px;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>I.</div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 6rem;">Berangkat dari</span>
                                <span>: {{ $spdp['tempat_berangkat'] }}</span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 6rem;">Ke</span>
                                <span>: {{ $spdp['tempat_tujuan'] }}</span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 6rem;">Pada Tanggal</span>
                                <span>: 18 Oktober 2022</span>
                            </div>
                            <div><strong>{{ $spdp['pegawai_jabatan'] }}</strong></div>
                            <br>
                            <br>
                            <br>
                            <div><strong>{{ $spdp['pegawai_nama'] }}</strong></div>
                            <div>NIP. {{ $spdp['pegawai_nip'] }}</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>II.</div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Tiba di</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <div><strong>Kepala</strong></div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div></div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Berangkat dari</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Ke</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <div><strong>Kepala</strong></div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>III.</div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Tiba di</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <br>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div></div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Berangkat dari</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Ke</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>IV.</div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Tiba di</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <br>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div></div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Berangkat dari</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Ke</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>V.</div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Tiba di</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <br>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div></div>
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Berangkat dari</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Ke</span>
                                <span>: </span>
                            </div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <div>Kepala</div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>(..............................................................................)</strong>
                            </div>
                            <div>NIP. </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Tiba di</span>
                                <span>: </span>
                            </div>
                            <div>(Tempat Kedudukan)</div>
                            <div>
                                <span style="display: inline-block; width: 8rem;">Pada Tanggal</span>
                                <span>: </span>
                            </div>
                            <br>
                            <div><strong>Pejabat Pembuat Komitmen</strong></div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>{{ $spdp['pembuat_komitmen_nama'] }}</strong>
                            </div>
                            <div>NIP. {{ $spdp['pembuat_komitmen_nip'] }}</div>
                        </div>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div style="display: flex; border: 0;">
                        <div>
                            <div>
                                Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan
                                semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
                            </div>
                            <div><strong>Pejabat Pembuat Komitmen</strong></div>
                            <br>
                            <br>
                            <br>
                            <div>
                                <strong>{{ $spdp['pembuat_komitmen_nama'] }}</strong>
                            </div>
                            <div>NIP. {{ $spdp['pembuat_komitmen_nip'] }}</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="display: flex; border: 0;">
                        <div>VII.</div>
                        <div>Catatan lain-lain</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div style="display: flex; border: 0;">
                        <div>VIII.</div>
                        <div>
                            <div>PERHATIAN</div>
                            <div>
                                PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang
                                mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab
                                berdasarkan peraturan-peraturan Keuangan Negara apabila Negara menderita rugi akibat
                                kesalahan, kelalaian dan kealpaannya.
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </main>
    <script>
        window.print();
    </script>
</body>

</html>
