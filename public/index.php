<?php
/**
 * This file is part of the Universe package.
 *
 * @author Volkan Şengül <iletisim@volkansengul.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
try {
    $app = new Universe\Singularity(__DIR__ . DIRECTORY_SEPARATOR, realpath('../') . DIRECTORY_SEPARATOR);
} catch (Exception $e){
    echo 'err : '.$e->getMessage();
}