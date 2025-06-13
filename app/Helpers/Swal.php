<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class Swal
{
    private static function initToast()
    {
        if (!Session::has('swals')) {
            Session::flash('swals', ["const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            })"]);
        }
    }

    public static function toast($title, $icon = 'success', $timer = 3000, $position = 'top-right')
    {
        self::initToast();
        $toast = "Toast.fire({
            title: '$title',
            icon: '$icon',
            timer: $timer,
            position: '$position',
            showConfirmButton: false,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })";
        
        $swals = Session::get('swals', []);
        $swals[] = $toast;
        Session::flash('swals', $swals);
    }

    public static function toastError($title, $timer = 3000)
    {
        return self::toast($title, 'error', $timer);
    }

    public static function toastSuccess($title, $timer = 3000)
    {
        return self::toast($title, 'success', $timer);
    }

    public static function toastWarning($title, $timer = 3000)
    {
        return self::toast($title, 'warning', $timer);
    }

    public static function toastInfo($title, $timer = 3000)
    {
        return self::toast($title, 'info', $timer);
    }

    public static function toastQuestion($title, $timer = 3000)
    {
        return self::toast($title, 'question', $timer);
    }

    public static function show()
    {
        if (!Session::has('swals')) {
            return '';
        }
        
        $swals = Session::get('swals', []);
        $output = "<script>\ndocument.addEventListener(\"DOMContentLoaded\", function () {\n" . implode("\n", $swals) . "\n});\n</script>";
        Session::forget('swals');
        return $output;
    }

    public static function fire($title, $icon = 'success', $timer = 3000)
    {
        self::initToast();
        $swal = "Swal.fire({
            title: '$title',
            icon: '$icon',
            timer: $timer,
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })";
        
        $swals = Session::get('swals', []);
        $swals[] = $swal;
        Session::flash('swals', $swals);
    }
}

