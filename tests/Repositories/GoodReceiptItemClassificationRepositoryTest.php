<?php namespace Tests\Repositories;

use App\Models\Warehouse\GoodReceiptItemClassification;
use App\Repositories\Warehouse\GoodReceiptItemClassificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GoodReceiptItemClassificationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GoodReceiptItemClassificationRepository
     */
    protected $goodReceiptItemClassificationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->goodReceiptItemClassificationRepo = \App::make(GoodReceiptItemClassificationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->make()->toArray();

        $createdGoodReceiptItemClassification = $this->goodReceiptItemClassificationRepo->create($goodReceiptItemClassification);

        $createdGoodReceiptItemClassification = $createdGoodReceiptItemClassification->toArray();
        $this->assertArrayHasKey('id', $createdGoodReceiptItemClassification);
        $this->assertNotNull($createdGoodReceiptItemClassification['id'], 'Created GoodReceiptItemClassification must have id specified');
        $this->assertNotNull(GoodReceiptItemClassification::find($createdGoodReceiptItemClassification['id']), 'GoodReceiptItemClassification with given id must be in DB');
        $this->assertModelData($goodReceiptItemClassification, $createdGoodReceiptItemClassification);
    }

    /**
     * @test read
     */
    public function test_read_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();

        $dbGoodReceiptItemClassification = $this->goodReceiptItemClassificationRepo->find($goodReceiptItemClassification->id);

        $dbGoodReceiptItemClassification = $dbGoodReceiptItemClassification->toArray();
        $this->assertModelData($goodReceiptItemClassification->toArray(), $dbGoodReceiptItemClassification);
    }

    /**
     * @test update
     */
    public function test_update_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();
        $fakeGoodReceiptItemClassification = GoodReceiptItemClassification::factory()->make()->toArray();

        $updatedGoodReceiptItemClassification = $this->goodReceiptItemClassificationRepo->update($fakeGoodReceiptItemClassification, $goodReceiptItemClassification->id);

        $this->assertModelData($fakeGoodReceiptItemClassification, $updatedGoodReceiptItemClassification->toArray());
        $dbGoodReceiptItemClassification = $this->goodReceiptItemClassificationRepo->find($goodReceiptItemClassification->id);
        $this->assertModelData($fakeGoodReceiptItemClassification, $dbGoodReceiptItemClassification->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_good_receipt_item_classification()
    {
        $goodReceiptItemClassification = GoodReceiptItemClassification::factory()->create();

        $resp = $this->goodReceiptItemClassificationRepo->delete($goodReceiptItemClassification->id);

        $this->assertTrue($resp);
        $this->assertNull(GoodReceiptItemClassification::find($goodReceiptItemClassification->id), 'GoodReceiptItemClassification should not exist in DB');
    }
}
