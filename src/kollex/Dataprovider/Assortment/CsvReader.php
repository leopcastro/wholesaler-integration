<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

class CsvReader
{
    private string $filePath;

    /**
     * @var false|resource
     */
    private $csvFileResource;

    public function __construct(string $filePath)
    {
        if (!is_file($filePath)) {
            throw new FileNotFound('File not found ' . $filePath);
        }

        $this->filePath = $filePath;
    }

    public function getData(): ?array
    {
        $this->initCsvFileResource();

        $rowData = fgetcsv($this->csvFileResource, 0, ';');

        if (!$rowData) {
            return null;
        }

        return $rowData;
    }

    private function initCsvFileResource(): void
    {
        if ($this->csvFileResource) {
            return;
        }

        $this->csvFileResource = fopen($this->filePath, 'r');

        // Skip columns header
        fgets($this->csvFileResource);
    }
}
