<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Warehouse\GoodReceipt;

class GoodReceiptApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/warehouse/good_receipts', $goodReceipt
        );

        $this->assertApiResponse($goodReceipt);
    }

    /**
     * @test
     */
    public function test_read_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipts/'.$goodReceipt->id
        );

        $this->assertApiResponse($goodReceipt->toArray());
    }

    /**
     * @test
     */
    public function test_update_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();
        $editedGoodReceipt = GoodReceipt::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/warehouse/good_receipts/'.$goodReceipt->id,
            $editedGoodReceipt
        );

        $this->assertApiResponse($editedGoodReceipt);
    }

    /**
     * @test
     */
    public function test_delete_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/warehouse/good_receipts/'.$goodReceipt->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/warehouse/good_receipts/'.$goodReceipt->id
        );

        $this->response->assertStatus(404);
    }
}
