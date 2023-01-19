<?php

namespace Spout\Writer\Common\Manager;

use TA\Spout\Common\Entity\Cell;
use TA\Spout\Writer\Common\Creator\Style\StyleBuilder;
use TA\Spout\Writer\Common\Manager\CellManager;
use TA\Spout\Writer\Common\Manager\Style\StyleMerger;
use PHPUnit\Framework\TestCase;

class CellManagerTest extends TestCase
{
    /**
     * @return void
     */
    public function testApplyStyle()
    {
        $cellManager = new CellManager(new StyleMerger());
        $cell = new Cell('test');

        $this->assertFalse($cell->getStyle()->isFontBold());

        $style = (new StyleBuilder())->setFontBold()->build();
        $cellManager->applyStyle($cell, $style);

        $this->assertTrue($cell->getStyle()->isFontBold());
    }
}
