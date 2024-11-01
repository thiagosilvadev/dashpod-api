<?php

namespace App\Modules\Audio\Lambda;

use App\Models\Episode;
use Aws\Lambda\LambdaClient;

class ProcessAudioLambda
{
    public function invoke(Episode $episode)
    {
        $lambda = new LambdaClient([
            'region' => 'us-east-1',
            'version' => 'latest',
            'endpoint' => 'http://172.17.0.1:3001',
            'credentials' => [
                'key' => 'dummy-key',
                'secret' => 'dummy-secret',
            ],
        ]); // Instância local

        $result = $lambda->invoke([
            'FunctionName' => 'dashpod-audio', // Nome da função Lambda
            'Payload' => json_encode([
                'bucket' => 'podcasts',
                'key' => $episode->audio_url,
                'coverImageKey' => $episode->cover_url,
            ]),
        ]);

        return json_decode($result->get('Payload')->getContents(), true);
    }
}
