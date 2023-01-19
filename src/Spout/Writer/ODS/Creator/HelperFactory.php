<?php

namespace TA\Spout\Writer\ODS\Creator;

use TA\Spout\Common\Helper\Escaper;
use TA\Spout\Common\Helper\StringHelper;
use TA\Spout\Common\Manager\OptionsManagerInterface;
use TA\Spout\Writer\Common\Creator\InternalEntityFactory;
use TA\Spout\Writer\Common\Entity\Options;
use TA\Spout\Writer\Common\Helper\ZipHelper;
use TA\Spout\Writer\ODS\Helper\FileSystemHelper;

/**
 * Class HelperFactory
 * Factory for helpers needed by the ODS Writer
 */
class HelperFactory extends \TA\Spout\Common\Creator\HelperFactory
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @param InternalEntityFactory $entityFactory
     * @return FileSystemHelper
     */
    public function createSpecificFileSystemHelper(OptionsManagerInterface $optionsManager, InternalEntityFactory $entityFactory)
    {
        $tempFolder = $optionsManager->getOption(Options::TEMP_FOLDER);
        $zipHelper = $this->createZipHelper($entityFactory);

        return new FileSystemHelper($tempFolder, $zipHelper);
    }

    /**
     * @param InternalEntityFactory $entityFactory
     * @return ZipHelper
     */
    private function createZipHelper($entityFactory)
    {
        return new ZipHelper($entityFactory);
    }

    /**
     * @return Escaper\ODS
     */
    public function createStringsEscaper()
    {
        return new Escaper\ODS();
    }

    /**
     * @return StringHelper
     */
    public function createStringHelper()
    {
        return new StringHelper();
    }
}
