<?php namespace Tests\Repositories;

use App\Models\Warehouse\GoodReceipt;
use App\Repositories\Warehouse\GoodReceiptRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class GoodReceiptRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var GoodReceiptRepository
     */
    protected $goodReceiptRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->goodReceiptRepo = \App::make(GoodReceiptRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->make()->toArray();

        $createdGoodReceipt = $this->goodReceiptRepo->create($goodReceipt);

        $createdGoodReceipt = $createdGoodReceipt->toArray();
        $this->assertArrayHasKey('id', $createdGoodReceipt);
        $this->assertNotNull($createdGoodReceipt['id'], 'Created GoodReceipt must have id specified');
        $this->assertNotNull(GoodReceipt::find($createdGoodReceipt['id']), 'GoodReceipt with given id must be in DB');
        $this->assertModelData($goodReceipt, $createdGoodReceipt);
    }

    /**
     * @test read
     */
    public function test_read_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();

        $dbGoodReceipt = $this->goodReceiptRepo->find($goodReceipt->id);

        $dbGoodReceipt = $dbGoodReceipt->toArray();
        $this->assertModelData($goodReceipt->toArray(), $dbGoodReceipt);
    }

    /**
     * @test update
     */
    public function test_update_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();
        $fakeGoodReceipt = GoodReceipt::factory()->make()->toArray();

        $updatedGoodReceipt = $this->goodReceiptRepo->update($fakeGoodReceipt, $goodReceipt->id);

        $this->assertModelData($fakeGoodReceipt, $updatedGoodReceipt->toArray());
        $dbGoodReceipt = $this->goodReceiptRepo->find($goodReceipt->id);
        $this->assertModelData($fakeGoodReceipt, $dbGoodReceipt->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_good_receipt()
    {
        $goodReceipt = GoodReceipt::factory()->create();

        $resp = $this->goodReceiptRepo->delete($goodReceipt->id);

        $this->assertTrue($resp);
        $this->assertNull(GoodReceipt::find($goodReceipt->id), 'GoodReceipt should not exist in DB');
    }
}
