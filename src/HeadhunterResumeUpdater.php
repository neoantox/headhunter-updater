<?php

namespace App;

use GuzzleHttp\Client;
use Katzgrau\KLogger\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class HeadhunterResumeUpdater
{
    /**
     * @var string
     */
    private $resumeId;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * HeadhunterResumeUpdater constructor.
     * @param string $resumeId
     * @param string $apiToken
     */
    public function __construct(string $resumeId, string $apiToken)
    {
        $this->resumeId = $resumeId;
        $this->apiToken = $apiToken;

        $this->logger = new Logger(__DIR__ . '/..', LogLevel::DEBUG, [
            'filename' => 'updater.log'
        ]);
    }

    /**
     * Обновление резюме
     *
     * @link https://github.com/hhru/api/blob/master/docs/resumes.md#Информация-о-статусе-резюме-и-готовности-резюме-к-публикации
     */
    public function update()
    {
        $client = new Client();

        $response = $client->request('post', 'https://api.hh.ru/resumes/' . $this->resumeId . '/publish', [
            'headers' => [
                'User-Agent: HeadhunterResume (anton@rudnikov.net)',
                'Authorization' => 'Bearer ' . $this->apiToken
            ],
            'http_errors' => false
        ]);

        switch ($response->getStatusCode()) {
            case 204:
                $this->logger->info('Резюме успешно обновлено');
                break;

            case 429:
                $this->logger->warning('Обновление резюме еще не доступно');
                break;

            default:
                $this->logger->error('Не удалось продлить резюме');
        }
    }
}