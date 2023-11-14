<?php
if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d H:i:s')
    {
        try {
            if (!$date) {
                return $date;
            }
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
        } catch (\Exception $e) {
            $date = date($format, strtotime($date));
        }
        return $date;
    }
}

if (!function_exists('getConst')) {
    function getConst($key = "", $defaultValue = "")
    {
        return config('const.'.$key,$defaultValue);
    }
}

// if (!function_exists('getStatusBookingRoom')) {
//     function getStatusBookingRoom($status)
//     {
//         switch ($status) {
//             case getConst('booking-room.status.pending'):
//                 return '<span class="text-warning">Đang chờ duyệt</span>';
//                 break;
//             case getConst('booking-room.status.approve'):
//                 return '<span class="text-success">Đã duyệt</span>';
//                 break;
//             case getConst('booking-room.status.expire'):
//                 return '<span class="text-warning">Đã được sử dụng</span>';
//                 break;
//             case getConst('booking-room.status.reject'):
//                 return '<span class="text-danger">Hủy</span>';
//                 break;
//         }
//         return false;
//     }
// }

if (!function_exists('getNameRegion')) {
    function getNameRegion($region)
    {
        switch ($region) {
            case getConst('region.system.key'):
                return getConst('region.system.value');
                break;
            case getConst('region.north.key'):
                return getConst('region.north.value');
                break;
            case getConst('region.central_region.key'):
                return getConst('region.central_region.value');
                break;
            case getConst('region.southern.key'):
                return getConst('region.southern.value');
                break;
        }
        return false;
    }
}

// if (!function_exists('getDataRegion')) {
//     function getDataRegion($status)
//     {
//         switch ($status) {
//             case getConst('region.system'):
//                 return 'Giới thiệu hệ thống';
//                 break;
//             case getConst('region.north'):
//                 return 'TTTH Miền Bắc';
//                 break;
//             case getConst('region.central_region'):
//                 return 'TTTH Miền Trung';
//                 break;
//             case getConst('region.southern'):
//                 return 'TTTH Miền Nam';
//                 break;
//         }
//         return false;
//     }
// }

// if (!function_exists('LogError')) {
//     function LogError($exception = '')
//     {
//         Illuminate\Support\Facades\Log::error($exception);
//     }
// }