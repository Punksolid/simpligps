<?php


namespace App\Services;


use App\Device;
use Faker\Generator;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Str;
use Javleds\Traccar\Facades\Client;
use Javleds\Traccar\Models\Device as TraccarDevice;
use Punksolid\Wialon\WialonErrorException;

class RegisterDevice
{
    private array $attributes;
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $client;

    /**
     * RegisterDevice constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return Device
     * @throws \Exception
     */
    public function __invoke(array $all)
    {
        if (config('traccar.base_url')) {

            return TraccarDevice::store($all['name'], $all['internal_number'] ?? null);

        }
        if (config('services.wialon.token') !== null) {
            /** @var Device $device */
            $device = new Device($all);

            return $device->createExternalDevice();
        }

        throw new \Exception('No service is configured');

    }

    private function getClient()
    {
        if ($this->client !== null) {
            return $this->client;
        }

        return $this->client = new GuzzleClient([
            'base_uri' => config('traccar.base_url'),
            'auth' => [config('traccar.auth.username'), config('traccar.auth.password')],
        ]);
    }

    public function setClient(GuzzleClient $guzzleClient)
    {
        $this->client = $guzzleClient;

        return $this;
    }

}