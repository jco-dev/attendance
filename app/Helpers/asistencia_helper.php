<?php

/** LITERAL DATE*/
if (!function_exists('literal_date')) {
    function literal_date($date, $format = 0)
    {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array(
            1 => "enero", "febrero", "marzo", "Abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
        );
        $infofecha = getdate(strtotime($date));
        if (empty($date)) {
            return ('');
        } else {
            switch ($format) {
                case 1:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'];
                    break;
                case 2:
                    return $dias[$infofecha['wday']] . ', ' . ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'];
                    break;
                case 3:
                    return $dias[$infofecha['wday']] . ', ' . ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'] . ' [Hrs. ' . ($infofecha['hours'] < 10 ? '0' : '') . $infofecha['hours'] . ':' . ($infofecha['minutes'] < 10 ? '0' : '') . $infofecha['minutes'] . ']';
                    break;
                case 5:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . ' de ' . $meses[$infofecha['mon']] . ' de ' . $infofecha['year'] . ' [Hrs. ' . ($infofecha['hours'] < 10 ? '0' : '') . $infofecha['hours'] . ':' . ($infofecha['minutes'] < 10 ? '0' : '') . $infofecha['minutes'] . ']';
                    break;
                case 9:
                    return ($infofecha['mday'] < 10 ? '0' : '') . $infofecha['mday'] . '/' . substr(strtolower($meses[$infofecha['mon']]), 0, 3);
                    break;
                case 10:
                    return $infofecha['year'];
                    break;
                case 20:
                    return $infofecha['mon'];
                    break;
                case 30:
                    return $infofecha['mday'];
                    break;
                default:
                    return date('Y-m-d H:i:s', strtotime($date));
                    break;
            }
        }
    }
}
/** END LITERAL DATE */