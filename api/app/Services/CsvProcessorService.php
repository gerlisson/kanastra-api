<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class CsvProcessorService
{
    public function process(string $filePath, int $batchSize)
    {
        $dataBatch = [];
        $startTime = microtime(true);
        $firstRow = true;

        SimpleExcelReader::create(Storage::path($filePath))
            ->getRows()
            ->each(function (array $row) use (&$dataBatch, &$firstRow, $batchSize) {

                // Se for a primeira linha, assumimos que são os cabeçalhos
                if ($firstRow) {
                    $this->validateCsvHeaders($row);
                    $firstRow = false;
                    return;
                }

                $dataBatch[] = [
                    'name' => $row['name'],
                    'governmentId' => $row['governmentId'],
                    'email' => $row['email'],
                    'debtAmount' => $row['debtAmount'],
                    'debtDueDate' => $row['debtDueDate'],
                    'debtId' => $row['debtId']
                ];

                if (count($dataBatch) >= $batchSize) {
                    $this->insertBatch($dataBatch);
                    $dataBatch = [];
                }
            });

        // Inserir os dados restantes
        if (!empty($dataBatch)) {
            $this->insertBatch($dataBatch);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        return $executionTime;
    }

    private function validateCsvHeaders(array $headers)
    {
        $expectedHeaders = ['name', 'governmentId', 'email', 'debtAmount', 'debtDueDate', 'debtId'];
        
        foreach ($expectedHeaders as $item) {

            if (!array_key_exists($item, $headers)) {
                throw new \Exception("O arquivo CSV não contém o cabeçalho esperado '$expectedHeader' na posição $index.");
            }
        }
    }

    private function insertBatch(array $dataBatch)
    {
        DB::table('boletos')->insert($dataBatch);
    }
}
