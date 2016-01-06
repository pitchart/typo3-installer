<?php

namespace Pitchart\Typo3Installer\Service;


class TarExtractor {

    public function extract($archive, $remove = false) {
        exec(sprintf('tar -zxvf %s 2> /dev/null', $archive));

        $archiveInformations = pathinfo($archive);
        $extracted = $archiveInformations['dirname'].'/'.$archiveInformations['filename'];

        if (file_exists($extracted) && is_dir($extracted)) {
            if ($remove) {
                exec('rm '.$archive);
            }
            return $extracted;
        }
        return false;
    }

}