<?php

namespace TA\Spout\Reader\Common\Creator;

use TA\Spout\Common\Exception\UnsupportedTypeException;
use TA\Spout\TestUsingResource;
use PHPUnit\Framework\TestCase;

class ReaderEntityFactoryTest extends TestCase
{
    use TestUsingResource;

    /**
     * @return void
     */
    public function testCreateFromFileCSV()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($validCsv);
        $this->assertInstanceOf('TA\Spout\Reader\CSV\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileCSVAllCaps()
    {
        $validCsv = $this->getResourcePath('csv_test_create_from_file.CSV');
        $reader = ReaderEntityFactory::createReaderFromFile($validCsv);
        $this->assertInstanceOf('TA\Spout\Reader\CSV\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileODS()
    {
        $validOds = $this->getResourcePath('csv_test_create_from_file.ods');
        $reader = ReaderEntityFactory::createReaderFromFile($validOds);
        $this->assertInstanceOf('TA\Spout\Reader\ODS\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileXLSX()
    {
        $validXlsx = $this->getResourcePath('csv_test_create_from_file.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($validXlsx);
        $this->assertInstanceOf('TA\Spout\Reader\XLSX\Reader', $reader);
    }

    /**
     * @return void
     */
    public function testCreateFromFileUnsupported()
    {
        $this->expectException(UnsupportedTypeException::class);
        $invalid = $this->getResourcePath('test_unsupported_file_type.other');
        ReaderEntityFactory::createReaderFromFile($invalid);
    }

    /**
     * @return void
     */
    public function testCreateFromFileMissingShouldWork()
    {
        $notExistingFile = 'thereisnosuchfile.csv';
        $reader = ReaderEntityFactory::createReaderFromFile($notExistingFile);
        $this->assertInstanceOf('TA\Spout\Reader\CSV\Reader', $reader);
    }
}
