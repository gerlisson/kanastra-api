<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CsvProcessorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class BoletoController extends Controller
{
    private $csvProcessorService;

    public function __construct(CsvProcessorService $csvProcessorService)
    {
        $this->csvProcessorService = $csvProcessorService;
    }

    public function uploadCsv(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:csv,txt',
            ]);

            $filePath = $request->file('file')->store('uploads');

            if (!Storage::exists($filePath)) {
                return response()->json(['error' => 'File does not exist.'], 404);
            }

            $batchSize = 1000;

            // Processar o CSV e calcular o tempo de execução
            $executionTime = $this->csvProcessorService->process($filePath, $batchSize);

            return response()->json(['message' => 'Boletos inseridos com sucesso!', 'execution_time' => $executionTime], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao processar o arquivo CSV: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao processar o arquivo CSV.'], 500);
        }
    }
}
