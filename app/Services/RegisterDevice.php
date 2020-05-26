<?php


namespace App\Services;


use App\Device;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Str;
use Javleds\Traccar\Facades\Client;
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
     * @param array $all
     * @param GuzzleClient $client
     */
    public function __construct(array $all )
    {
        $this->attributes = $all;

    }

    /**
     * @return Device
     * @throws \Exception
     */
    public function __invoke()
    {

        $device = new Device($this->attributes);
        $this->createExternalDevice($device);
        $device->save();

        return $device;
    }

    private function createExternalDevice($device)
    {
        if (env('TRACCAR_BASE_URL')) {
            $body = [
                'id' => -1,
                'name' => $this->attributes['name'],
                'uniqueId' => Str::uuid(),
                "phone" => '',
                "model" => '',
                "contact" => '',
                "category" => null,
                "status" => null,
                "lastUpdate" => null,
                "groupId" => 0,
                "disabled" => false,
            ];

            $result = $this->getClient()->post('/api/devices',[
                'body' => json_encode($body),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            return json_decode($result->getBody()->getContents());

        }
        if (config('services.wialon.token') !== null) {
            return $device->createExternalDevice();
        }

        throw new \Exception('No service is configured');
    }

    private function getClient()
    {
        if ($this->client !== null){
            return $this->client;
        }

        return $this->client = new GuzzleClient([
            'base_uri' => config('traccar.base_url'),
            'auth'     => [config('traccar.auth.username'), config('traccar.auth.password')],
        ]);
    }

    public function setClient(GuzzleClient $guzzleClient)
    {
        $this->client = $guzzleClient;

        return $this;
    }

}