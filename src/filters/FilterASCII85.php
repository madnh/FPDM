<?php
namespace FPDM\Filters;


class FilterASCII85
{
    const ORD_z = 122;
    const ORD_exclmark = 33;
    const ORD_u = 117;
    const ORD_tilde = 126;

    public function decode($in)
    {
        $out = '';
        $state = 0;
        $chn = null;

        $l = strlen($in);

        for ($k = 0; $k < $l; ++$k) {
            $ch = ord($in[$k]) & 0xff;

            if ($ch == self::ORD_tilde) {
                break;
            }
            if (preg_match('/^\s$/', chr($ch))) {
                continue;
            }
            if ($ch == self::ORD_z && $state == 0) {
                $out .= chr(0) . chr(0) . chr(0) . chr(0);
                continue;
            }
            if ($ch < self::ORD_exclmark || $ch > self::ORD_u) {
                throw new \Exception('Illegal character in ASCII85Decode.');
            }

            $chn[$state++] = $ch - self::ORD_exclmark;

            if ($state == 5) {
                $state = 0;
                $r = 0;
                for ($j = 0; $j < 5; ++$j)
                    $r = $r * 85 + $chn[$j];
                $out .= chr($r >> 24);
                $out .= chr($r >> 16);
                $out .= chr($r >> 8);
                $out .= chr($r);
            }
        }

        if ($state == 1)
            throw new \Exception('Illegal length in ASCII85Decode.');
        if ($state == 2) {
            $r = $chn[0] * 85 * 85 * 85 * 85 + ($chn[1] + 1) * 85 * 85 * 85;
            $out .= chr($r >> 24);
        } else if ($state == 3) {
            $r = $chn[0] * 85 * 85 * 85 * 85 + $chn[1] * 85 * 85 * 85 + ($chn[2] + 1) * 85 * 85;
            $out .= chr($r >> 24);
            $out .= chr($r >> 16);
        } else if ($state == 4) {
            $r = $chn[0] * 85 * 85 * 85 * 85 + $chn[1] * 85 * 85 * 85 + $chn[2] * 85 * 85 + ($chn[3] + 1) * 85;
            $out .= chr($r >> 24);
            $out .= chr($r >> 16);
            $out .= chr($r >> 8);
        }

        return $out;
    }

    public function encode($in)
    {
        throw new \Exception("ASCII85 encoding not implemented.");
    }
}