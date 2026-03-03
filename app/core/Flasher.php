<?php

class Flasher {
    public static function setFlash($pesan, $aksi, $tipe) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    public static function flash() {
        if( isset($_SESSION['flash']) ) {
            $tipe = $_SESSION['flash']['tipe'];
            if($tipe == 'danger') $tipe = 'error';
            
            $pesan = $_SESSION['flash']['pesan'];
            $aksi = $_SESSION['flash']['aksi'];
            
            $isToast = ($tipe == 'success') ? 'true' : 'false';
            $position = ($tipe == 'success') ? 'top-end' : 'center';

            echo "
            <script>
                (function() {
                    const showSnack = () => {
                        if (typeof Swal === 'undefined') {
                            console.error('SweetAlert2 not loaded');
                            return;
                        }
                        Swal.fire({
                            title: " . json_encode($pesan) . ",
                            text: " . json_encode($aksi) . ",
                            icon: '" . $tipe . "',
                            toast: " . $isToast . ",
                            position: '" . $position . "',
                            showConfirmButton: " . ($isToast == 'true' ? 'false' : 'true') . ",
                            timer: 3500,
                            timerProgressBar: true,
                            background: '#ffffff',
                            color: '#0f172a',
                            customClass: {
                                popup: 'premium-swal-popup',
                                title: 'premium-swal-title'
                            }
                        });
                    };
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', showSnack);
                    } else {
                        showSnack();
                    }
                })();
            </script>
            <style>
                .premium-swal-popup { border-radius: 15px !important; box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; }
                .premium-swal-title { font-weight: 700 !important; font-family: sans-serif; }
            </style>
            ";
            unset($_SESSION['flash']);
        }
    }
}
