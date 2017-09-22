<?php

declare(strict_types=1);

namespace Phpml\Dataset;

use Phpml\Exception\DatasetException;

class CsvDataset extends ArrayDataset
{
    /**
     * @param string $filepath
     * @param int    $features
     * @param bool   $headingRow
     *
     * @throws DatasetException
     */
    public function __construct(string $filepath, int $features, bool $headingRow = true)
    {
        if (!file_exists($filepath)) {
            throw DatasetException::missingFile(basename($filepath));
        }

        if (false === $handle = fopen($filepath, 'r')) {
            throw DatasetException::cantOpenFile(basename($filepath));
        }

        if ($headingRow) {
            fgets($handle);
        }

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $this->samples[] = array_slice($data, 0, $features);
            $this->targets[] = $data[$features];
        }
        fclose($handle);
    }
}
