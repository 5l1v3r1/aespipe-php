<?php

namespace Andrewhood125;

use Symfony\Component\Process\Process;

class AESPipe
{
    /**
     * Decrypt to $out and delete $in.
     */
    public static function decrypt($in, $out) {
        self::invoke($in, $out, "-d");
    }

    /**
     * Encrypt to $out and delete $in.
     */
    public static function encrypt($in, $out) {
        self::invoke($in, $out, "");
    }

    private static function invoke($in, $out, $options) {
        $keyFile = getenv('ENCRYPTION_KEY');
        $aespipe = new Process("aespipe $options -e aes256 -P ${keyFile} <${in} >${out}");
        $aespipe->mustRun();
        unlink($in);
    }
}
