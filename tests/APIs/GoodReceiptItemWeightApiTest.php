<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Warehouse\GoodReceiptItemWeight;

class GoodReceiptItemWeightApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/warehouse/good_receipt_item_weights', $goodReceiptItemWeight
        );

        $this->assertApiResponse($goodReceiptItemWeight);
    }

    /**
     * @test
     */
    public function test_read_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_item_weights/'.$goodReceiptItemWeight->id
        );

        $this->assertApiResponse($goodReceiptItemWeight->toArray());
    }

    /**
     * @test
     */
    public function test_update_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();
        $editedGoodReceiptItemWeight = GoodReceiptItemWeight::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/warehouse/good_receipt_item_weights/'.$goodReceiptItemWeight->id,
            $editedGoodReceiptItemWeight
        );

        $this->assertApiResponse($editedGoodReceiptItemWeight);
    }

    /**
     * @test
     */
    public function test_delete_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/warehouse/good_receipt_item_weights/'.$goodReceiptItemWeight->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_item_weights/'.$goodReceiptItemWeight->id
        );

        $this->response->assertStatus(404);
    }
}
