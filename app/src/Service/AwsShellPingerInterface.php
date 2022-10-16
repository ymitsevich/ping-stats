<?php

namespace App\Service;

use App\Dto\PingResponse;
use App\Factory\PingResponseFactory;
use Symfony\Component\Console\Command\Command;

class AwsShellPingerInterface implements PingerInterface
{
    private const DESTINATION_IP_ADDRESS = '1.1.1.1';
    private const ATTEMPTS_COUNT = 1;

    public function __construct(
        private readonly PingResponseFactory $pingResponseFactory,
    ) {
    }

    public function ping(): PingResponse
    {
        $output = [];
        $returnValue = null;
        exec('ping -c ' . self::ATTEMPTS_COUNT . ' ' . self::DESTINATION_IP_ADDRESS, $output, $returnValue);

        $matches = [];
        $output = implode(PHP_EOL, $output);

        $pregResult = preg_match("/.*time=(?<ping>.*)\sms/", $output, $matches);
        $ping = $pregResult && array_key_exists('ping', $matches) ? (int) $matches['ping'] : null;

        return $this->pingResponseFactory->create($returnValue === Command::SUCCESS, $ping, $output);
    }
}
