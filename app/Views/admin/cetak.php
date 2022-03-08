<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Cetak Surat</title>

   


    <style type="text/css">
        html body {
            overflow-x: hidden;
        }

        .hide {
            display: none;
        }

        .alert {
            color: white !important;
        }
    </style>
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <section>
        <div class="tab-pane p-4" id="profile2" role="tabpanel">
            <div class="col-md-12 p-4" id="print" style="padding-top: 10px; padding-right: 50px; padding-left: 50px;">
                <br>
                <ul class="media-list row" style="border: 0px!important;margin-left: -50px;margin-right: -50px;">
                    <li class="media" style="border: 0px!important;">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object width-170" src="<?php echo base_url('assets/aye.png') ?>" alt="Generic placeholder image" style="width: 120px;">
                            </a>
                        </div>
                        <div class="media-body media-search">
                            <center>
                                <h3 style="font-size: 1.5em;letter-spacing: 3px;">KEMENTRIAN PERHUBUNGAN</h3>
                                <h3 style="font-size: 1.5em;letter-spacing: 3px; margin-top: -10px;">DIREKTORAT JENDRAL PERHUBUNGAN LAUT</h3>
                                <h3 style="font-size: 1.5em;letter-spacing: 3px;">KANTOR KESYAHBANDARAN DAN OTORITAS PELABUHAN KELAS II GRESIK</h3>
                                <span style="font-size: 1em;letter-spacing: 1.4px">Alamat : Jl. Yos Sudarso No. 36 Gresik Jawa Timur 61114 TELP: (031)3981902 FAX: 3990588</span><br>
                                <span style="font-size: 1em;letter-spacing: 1.4px"><i>email : ksop_gresik@dephub.go.id/adpelgresik@yahoo.com</i></span>
                            </center>
                        </div>
                    </li>
                </ul>
                <hr>

                <span style="float: right;margin-right: 150px;" id="tempat">Gresik,</span><br>
                <span style="float: right;margin-right: 150px;">Kepada:</span><br>
                <span style="float: right;margin-right: 0px; width: 200px;" id="kepada"></span>
                <p>

                </p>
                <!-- <p style="margin-top: -10px!important;">Nomor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="nomor"></span></p>
                <p style="margin-top: -10px!important;">Sifat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="sifat"></span></p>
                <p style="margin-top: -10px!important;">Lampiran &nbsp;&nbsp;&nbsp;&nbsp;: <span id="lampiran"></span></p>
                <p style="margin-top: -10px!important;">Perihal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span ><u><b id="perihal"></b></u></span></p> -->
                <p style="top: 0px;" id="isi"></p>
                <p style="text-align: right; right: 60px;margin-top: 100px;">Kepala KSOP Gresik</p>
                <br>
                <br>
                <br>
                <p style="text-align: right;"><u><b>R Totok Mukarto</b></u><br>Pembina Tingkat 1 <br> NIP : 19610504 198209 1001</p>
                <span style="text-align: left;left: 80px;">Tembusan:</span><br>
                <p id="tembusan"></p>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>