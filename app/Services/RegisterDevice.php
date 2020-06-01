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
    public function __invoke(Device $device)
    {
        if (config('traccar.base_url')) {

            $traccar_device = TraccarDevice::store($device->name, $device->internal_number ?? null);
            $device->wialon_id = $traccar_device->getId();
            $device->reference_data = $traccar_device;
            return $device;
        }
        if (config('services.wialon.token') !== null) {
            $device->createExternalDevice();

            return $device;

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