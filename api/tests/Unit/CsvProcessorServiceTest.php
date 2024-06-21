<?php

namespace Tests\Unit;

use App\Services\CsvProcessorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Historico;

class CsvProcessorServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testExecutionTimeMustBeLessThan_60Seconds()
    {
        // Configurar o sistema de armazenamento falso do Laravel
        Storage::fake('local');

        $filePath = 'uploads/test.csv';

        // Criar um arquivo CSV fictício com os cabeçalhos e dados
        $fileContent = "name,governmentId,email,debtAmount,debtDueDate,debtId\nElijah Santos,9558,janet95@example.com,7811,2024-01-19,ea23f2ca-663a-4266-a742-9da4c9f4fcb3\n";
        Storage::disk('local')->put($filePath, $fileContent);

        // Criar uma instância do serviço CsvProcessorService
        $historico = new Historico();
        $service = new CsvProcessorService($historico);
        
        $batchSize = 1000;
        
        // Chamar o método do serviço para processar o arquivo CSV
        $startTime = microtime(true);
        $executionTime = $service->process($filePath, $batchSize);
        $endTime = microtime(true);

        $this->assertGreaterThanOrEqual(0, $executionTime, 'O tempo de execução deve ser um número positivo.');

        $this->assertLessThan(60, $endTime - $startTime, "O tempo de execução foi menor que 60 segundos: " . ($endTime - $startTime));
    }
}
