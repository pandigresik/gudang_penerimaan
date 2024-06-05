<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Warehouse\GoodReceiptItemClassification;

class GoodReceiptItemClassificationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/warehouse/good_receipt_item_classifications', $goodReceiptItemClassification
        );

        $this->assertApiResponse($goodReceiptItemClassification);
    }

    /**
     * @test
     */
    public function test_read_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_item_classifications/'.$goodReceiptItemClassification->id
        );

        $this->assertApiResponse($goodReceiptItemClassification->toArray());
    }

    /**
     * @test
     */
    public function test_update_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();
        $editedGoodReceiptItemClassification = GoodReceiptItemClassification::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/warehouse/good_receipt_item_classifications/'.$goodReceiptItemClassification->id,
            $editedGoodReceiptItemClassification
        );

        $this->assertApiResponse($editedGoodReceiptItemClassification);
    }

    /**
     * @test
     */
    public function test_delete_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/warehouse/good_receipt_item_classifications/'.$goodReceiptItemClassification->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_item_classifications/'.$goodReceiptItemClassification->id
        );

        $this->response->assertStatus(404);
    }
}
