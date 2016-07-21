<?php

namespace Andrewhood125;

use Symfony\Component\Process\Process;

class AESPipe
{
    /**
     * Decrypt to $out and delete $in.
     */
    public static function decrypt($in, $out = null) {
        return self::invoke($in, $out, "-d");
    }

    /**
     * Encrypt to $out and delete $in.
     */
    public static function encrypt($in, $out = null) {
        return self::invoke($in, $out, "");
    }

    private static function invoke($in, $out, $options) {

        if(is_null($out)) {
            $out = tempnam(sys_get_temp_dir(), "");
        }

        $keyFile = getenv('ENCRYPTION_KEY');
        $aespipe = new Process("aespipe $options -e aes256 -P ${keyFile} <${in} >${out}");
        $aespipe->mustRun();
        unlink($in);
        return $out;
    }
}
