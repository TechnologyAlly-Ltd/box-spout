<?php

namespace TA\Spout\Writer\Common\Creator;

use TA\Spout\Common\Manager\OptionsManagerInterface;
use TA\Spout\Writer\Common\Manager\SheetManager;
use TA\Spout\Writer\Common\Manager\WorkbookManagerInterface;

/**
 * Interface ManagerFactoryInterface
 */
interface ManagerFactoryInterface
{
    /**
     * @param OptionsManagerInterface $optionsManager
     * @return WorkbookManagerInterface
     */
    public function createWorkbookManager(OptionsManagerInterface $optionsManager);

    /**
     * @return SheetManager
     */
    public function createSheetManager();
}
