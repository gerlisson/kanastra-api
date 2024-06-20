<?php

namespace Tests\Feature;

use App\Models\Boleto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BoletoControllerIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_upload_csv_file_and_process_data()
    {
        Storage::fake('local');

        $fileContent = "name,governmentId,email,debtAmount,debtDueDate,debtId\nElijah Santos,9558,janet95@example.com,7811,2024-01-19,ea23f2ca-663a-4266-a742-9da4c9f4fcb3\n";
        $file = UploadedFile::fake()->createWithContent('test.csv', $fileContent);

        $response = $this->postJson('/api/upload-csv', [
            'file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Boletos inseridos com sucesso!',
        ]);
    }
}
