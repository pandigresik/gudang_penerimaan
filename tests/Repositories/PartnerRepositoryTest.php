<?php namespace Tests\Repositories;

use App\Models\Base\Partner;
use App\Repositories\Base\PartnerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PartnerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PartnerRepository
     */
    protected $partnerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->partnerRepo = \App::make(PartnerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_partner()
    {
        $partner = Partner::factory()->make()->toArray();

        $createdPartner = $this->partnerRepo->create($partner);

        $createdPartner = $createdPartner->toArray();
        $this->assertArrayHasKey('id', $createdPartner);
        $this->assertNotNull($createdPartner['id'], 'Created Partner must have id specified');
        $this->assertNotNull(Partner::find($createdPartner['id']), 'Partner with given id must be in DB');
        $this->assertModelData($partner, $createdPartner);
    }

    /**
     * @test read
     */
    public function test_read_partner()
    {
        $partner = Partner::factory()->create();

        $dbPartner = $this->partnerRepo->find($partner->id);

        $dbPartner = $dbPartner->toArray();
        $this->assertModelData($partner->toArray(), $dbPartner);
    }

    /**
     * @test update
     */
    public function test_update_partner()
    {
        $partner = Partner::factory()->create();
        $fakePartner = Partner::factory()->make()->toArray();

        $updatedPartner = $this->partnerRepo->update($fakePartner, $partner->id);

        $this->assertModelData($fakePartner, $updatedPartner->toArray());
        $dbPartner = $this->partnerRepo->find($partner->id);
        $this->assertModelData($fakePartner, $dbPartner->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_partner()
    {
        $partner = Partner::factory()->create();

        $resp = $this->partnerRepo->delete($partner->id);

        $this->assertTrue($resp);
        $this->assertNull(Partner::find($partner->id), 'Partner should not exist in DB');
    }
}
