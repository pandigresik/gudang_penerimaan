<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Warehouse\GoodReceiptItem;

class GoodReceiptItemApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/warehouse/good_receipt_items', $goodReceiptItem
        );

        $this->assertApiResponse($goodReceiptItem);
    }

    /**
     * @test
     */
    public function test_read_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_items/'.$goodReceiptItem->id
        );

        $this->assertApiResponse($goodReceiptItem->toArray());
    }

    /**
     * @test
     */
    public function test_update_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();
        $editedGoodReceiptItem = GoodReceiptItem::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/warehouse/good_receipt_items/'.$goodReceiptItem->id,
            $editedGoodReceiptItem
        );

        $this->assertApiResponse($editedGoodReceiptItem);
    }

    /**
     * @test
     */
    public function test_delete_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/warehouse/good_receipt_items/'.$goodReceiptItem->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipt_items/'.$goodReceiptItem->id
        );

        $this->response->assertStatus(404);
    }
}
