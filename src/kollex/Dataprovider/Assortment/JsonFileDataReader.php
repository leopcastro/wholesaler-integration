<?php

declare(strict_types=1);

namespace kollex\Dataprovider\Assortment;

class JsonFileDataReader
{
    private string $filePath;

    private int $currentItemIndex = -1;

    private ?array $jsonData;

    public function __construct(string $filePath)
    {
        if (!is_file($filePath)) {
            throw new FileNotFound('File not found ' . $filePath);
        }

        $this->filePath = $filePath;
    }

    public function getData(): ?array
    {
        $this->initJsonFileResource();

        return $this->getItemFromJsonData();
    }

    private function initJsonFileResource(): void
    {
        if ($this->currentItemIndex >= 0) {
            return;
        }

        $jsonContent = \json_decode(file_get_contents($this->filePath), true);

        $this->jsonData = $jsonContent['data'];
        $this->currentItemIndex = 0;
    }

    private function getItemFromJsonData(): ?array
    {
        if (!$this->jsonData[$this->currentItemIndex]) {
            return null;
        }

        $item = $this->jsonData[$this->currentItemIndex];
        $this->currentItemIndex++;

        return $item;
    }
}
