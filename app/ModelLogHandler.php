<?php

namespace App;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Database\Eloquent\Model;

class ModelLogHandler extends AbstractProcessingHandler
{
    protected $table;
    protected $connection;
    protected $model;

    public function __construct(Model $model, $level = Logger::DEBUG, $bubble = true)
    {
        $this->model = $model;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record):void 
    {
        $data = [
            'message' => $record['message'],
            'channel' => $record['channel'],
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'context' => json_encode($record['context']),
            'loggable_type' => $record['loggable_type'] ?? 'App\Abstract',
            'loggable_id' => $record['loggable_id'] ?? 0,
        ];

        $this->model->create($data);
    }
}
