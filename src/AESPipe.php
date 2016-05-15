<?php

namespace Andrewhood125;

use Symfony\Component\Process\Process;

class AESPipe
{
    /**
     * Decrypt to $out and delete $in.
     */
    public static function decrypt($in, $out)
    {
        $keyFile = getenv('ENCRYPTION_KEY');
        $aespipe = new Process("aespipe -d -e aes256 -P ${keyFile} <${in} >${out}");
        $aespipe->mustRun();
        unlink($in);
    }
}
