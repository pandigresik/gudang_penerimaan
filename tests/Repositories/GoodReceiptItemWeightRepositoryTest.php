<?php namespace Tests\Repositories;

use App\Models\Warehouse\GoodReceiptItemWeight;
use App\Repositories\Warehouse\GoodReceiptItemWeightRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GoodReceiptItemWeightRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GoodReceiptItemWeightRepository
     */
    protected $goodReceiptItemWeightRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->goodReceiptItemWeightRepo = \App::make(GoodReceiptItemWeightRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->make()->toArray();

        $createdGoodReceiptItemWeight = $this->goodReceiptItemWeightRepo->create($goodReceiptItemWeight);

        $createdGoodReceiptItemWeight = $createdGoodReceiptItemWeight->toArray();
        $this->assertArrayHasKey('id', $createdGoodReceiptItemWeight);
        $this->assertNotNull($createdGoodReceiptItemWeight['id'], 'Created GoodReceiptItemWeight must have id specified');
        $this->assertNotNull(GoodReceiptItemWeight::find($createdGoodReceiptItemWeight['id']), 'GoodReceiptItemWeight with given id must be in DB');
        $this->assertModelData($goodReceiptItemWeight, $createdGoodReceiptItemWeight);
    }

    /**
     * @test read
     */
    public function test_read_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();

        $dbGoodReceiptItemWeight = $this->goodReceiptItemWeightRepo->find($goodReceiptItemWeight->id);

        $dbGoodReceiptItemWeight = $dbGoodReceiptItemWeight->toArray();
        $this->assertModelData($goodReceiptItemWeight->toArray(), $dbGoodReceiptItemWeight);
    }

    /**
     * @test update
     */
    public function test_update_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();
        $fakeGoodReceiptItemWeight = GoodReceiptItemWeight::factory()->make()->toArray();

        $updatedGoodReceiptItemWeight = $this->goodReceiptItemWeightRepo->update($fakeGoodReceiptItemWeight, $goodReceiptItemWeight->id);

        $this->assertModelData($fakeGoodReceiptItemWeight, $updatedGoodReceiptItemWeight->toArray());
        $dbGoodReceiptItemWeight = $this->goodReceiptItemWeightRepo->find($goodReceiptItemWeight->id);
        $this->assertModelData($fakeGoodReceiptItemWeight, $dbGoodReceiptItemWeight->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_good_receipt_item_weight()
    {
        $goodReceiptItemWeight = GoodReceiptItemWeight::factory()->create();

        $resp = $this->goodReceiptItemWeightRepo->delete($goodReceiptItemWeight->id);

        $this->assertTrue($resp);
        $this->assertNull(GoodReceiptItemWeight::find($goodReceiptItemWeight->id), 'GoodReceiptItemWeight should not exist in DB');
    }
}
