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
        if (isset($_SESSION['flash']) && is_array($_SESSION['flash'])) {
            $tipe  = $_SESSION['flash']['tipe'] ?? 'info';
            $pesan = $_SESSION['flash']['pesan'] ?? '';
            $aksi  = $_SESSION['flash']['aksi'] ?? '';

            // Map bootstrap/common types to SweetAlert2 icons
            $iconMap = [
                'danger'  => 'error',
                'warning' => 'warning',
                'success' => 'success',
                'info'    => 'info'
            ];
            $validIcon = $iconMap[$tipe] ?? $tipe;
            
            // Premium layout settings - Now all centered for clear debugging visibility
            $isToast  = 'false';
            $position = 'center';

            $jsonPesan = json_encode($pesan);
            $jsonAksi  = json_encode($aksi);

            echo "
            <script>
                (function() {
                    const notify = () => {
                        if (typeof Swal === 'undefined') return;
                        Swal.fire({
                            title: {$jsonPesan},
                            text: {$jsonAksi},
                            icon: '{$validIcon}',
                            toast: {$isToast},
                            position: '{$position}',
                            showConfirmButton: " . ($isToast === 'true' ? 'false' : 'true') . ",
                            timer: 4000,
                            timerProgressBar: true,
                            background: '#ffffff',
                            color: '#1e293b',
                            padding: '1.5rem',
                            customClass: {
                                popup: 'premium-popup',
                                title: 'premium-title',
                                htmlContainer: 'premium-text',
                                confirmButton: 'premium-button'
                            },
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown animate__faster'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp animate__faster'
                            }
                        });
                    };
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', notify);
                    } else {
                        notify();
                    }
                })();
            </script>
            <style>
                .premium-popup {
                    border-radius: 24px !important;
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
                    border: 1px solid rgba(226, 232, 240, 0.8) !important;
                }
                .premium-title {
                    font-size: 1.25rem !important;
                    font-weight: 800 !important;
                    color: #0f172a !important;
                    letter-spacing: -0.025em !important;
                }
                .premium-text {
                    font-weight: 500 !important;
                    color: #64748b !important;
                }
                .premium-button {
                    padding: 0.75rem 2rem !important;
                    border-radius: 14px !important;
                    font-weight: 700 !important;
                    background: #0f172a !important;
                    transition: all 0.2s !important;
                }
                .premium-button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
                }
            </style>
            ";
            unset($_SESSION['flash']);
        }
    }
}
