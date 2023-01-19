<?php

namespace TA\Spout\Reader\XLSX;

use TA\Spout\Reader\Exception\NoSheetsFoundException;
use TA\Spout\Reader\IteratorInterface;
use TA\Spout\Reader\XLSX\Manager\SheetManager;

/**
 * Class SheetIterator
 * Iterate over XLSX sheet.
 */
class SheetIterator implements IteratorInterface
{
    /** @var \TA\Spout\Reader\XLSX\Sheet[] The list of sheet present in the file */
    protected $sheets;

    /** @var int The index of the sheet being read (zero-based) */
    protected $currentSheetIndex;

    /**
     * @param SheetManager $sheetManager Manages sheets
     * @throws \TA\Spout\Reader\Exception\NoSheetsFoundException If there are no sheets in the file
     */
    public function __construct($sheetManager)
    {
        // Fetch all available sheets
        $this->sheets = $sheetManager->getSheets();

        if (\count($this->sheets) === 0) {
            throw new NoSheetsFoundException('The file must contain at least one sheet.');
        }
    }

    /**
     * Rewind the Iterator to the first element
     * @see http://php.net/manual/en/iterator.rewind.php
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->currentSheetIndex = 0;
    }

    /**
     * Checks if current position is valid
     * @see http://php.net/manual/en/iterator.valid.php
     *
     * @return bool
     */
    public function valid(): bool
    {
        return ($this->currentSheetIndex < \count($this->sheets));
    }

    /**
     * Move forward to next element
     * @see http://php.net/manual/en/iterator.next.php
     *
     * @return void
     */
    public function next(): void
    {
        // Using isset here because it is way faster than array_key_exists...
        if (isset($this->sheets[$this->currentSheetIndex])) {
            $currentSheet = $this->sheets[$this->currentSheetIndex];
            $currentSheet->getRowIterator()->end();

            $this->currentSheetIndex++;
        }
    }

    /**
     * Return the current element
     * @see http://php.net/manual/en/iterator.current.php
     *
     * @return \TA\Spout\Reader\XLSX\Sheet
     */
    public function current(): mixed
    {
        return $this->sheets[$this->currentSheetIndex];
    }

    /**
     * Return the key of the current element
     * @see http://php.net/manual/en/iterator.key.php
     *
     * @return int
     */
    public function key(): mixed
    {
        return $this->currentSheetIndex + 1;
    }

    /**
     * Cleans up what was created to iterate over the object.
     *
     * @return void
     */
    public function end()
    {
        // make sure we are not leaking memory in case the iteration stopped before the end
        foreach ($this->sheets as $sheet) {
            $sheet->getRowIterator()->end();
        }
    }
}
