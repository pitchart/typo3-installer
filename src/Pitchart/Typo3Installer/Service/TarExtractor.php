<?php

namespace Pitchart\Typo3Installer\Service;

/**
 * Class TarExtractor
 * @package Pitchart\Typo3Installer\Service
 * @author Julien VITTE <vitte.julien@gmail.com>
 */
class TarExtractor {

    public function extract($archive, $remove = false) {
        exec(sprintf('tar -zxvf %s -C %s 2> /dev/null', $archive, pathinfo($archive, PATHINFO_DIRNAME)));

        $archiveInformations = pathinfo($archive);
        $extracted = $archiveInformations['dirname'].'/typo3_src-'.$archiveInformations['filename'];

        if (file_exists($extracted) && is_dir($extracted)) {
            if ($remove) {
                exec('rm '.$archive);
            }
            return $extracted;
        }
        return false;
    }

}