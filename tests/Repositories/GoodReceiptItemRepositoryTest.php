<?php namespace Tests\Repositories;

use App\Models\Warehouse\GoodReceiptItem;
use App\Repositories\Warehouse\GoodReceiptItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GoodReceiptItemRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GoodReceiptItemRepository
     */
    protected $goodReceiptItemRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->goodReceiptItemRepo = \App::make(GoodReceiptItemRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->make()->toArray();

        $createdGoodReceiptItem = $this->goodReceiptItemRepo->create($goodReceiptItem);

        $createdGoodReceiptItem = $createdGoodReceiptItem->toArray();
        $this->assertArrayHasKey('id', $createdGoodReceiptItem);
        $this->assertNotNull($createdGoodReceiptItem['id'], 'Created GoodReceiptItem must have id specified');
        $this->assertNotNull(GoodReceiptItem::find($createdGoodReceiptItem['id']), 'GoodReceiptItem with given id must be in DB');
        $this->assertModelData($goodReceiptItem, $createdGoodReceiptItem);
    }

    /**
     * @test read
     */
    public function test_read_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();

        $dbGoodReceiptItem = $this->goodReceiptItemRepo->find($goodReceiptItem->id);

        $dbGoodReceiptItem = $dbGoodReceiptItem->toArray();
        $this->assertModelData($goodReceiptItem->toArray(), $dbGoodReceiptItem);
    }

    /**
     * @test update
     */
    public function test_update_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();
        $fakeGoodReceiptItem = GoodReceiptItem::factory()->make()->toArray();

        $updatedGoodReceiptItem = $this->goodReceiptItemRepo->update($fakeGoodReceiptItem, $goodReceiptItem->id);

        $this->assertModelData($fakeGoodReceiptItem, $updatedGoodReceiptItem->toArray());
        $dbGoodReceiptItem = $this->goodReceiptItemRepo->find($goodReceiptItem->id);
        $this->assertModelData($fakeGoodReceiptItem, $dbGoodReceiptItem->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_good_receipt_item()
    {
        $goodReceiptItem = GoodReceiptItem::factory()->create();

        $resp = $this->goodReceiptItemRepo->delete($goodReceiptItem->id);

        $this->assertTrue($resp);
        $this->assertNull(GoodReceiptItem::find($goodReceiptItem->id), 'GoodReceiptItem should not exist in DB');
    }
}
