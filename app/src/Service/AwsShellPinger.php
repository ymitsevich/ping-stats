<?php

namespace App\Service;

use App\Dto\PingResponse;
use App\Exception\ShellCommandException;
use App\Factory\PingResponseFactory;

class AwsShellPinger implements PingerInterface
{
    private const DESTINATION_IP_ADDRESS = '1.1.1.1';
    private const ATTEMPTS_COUNT = 1;

    public function __construct(
        private readonly CommandExecutorInterface $commandExecutor,
        private readonly PingResponseFactory $pingResponseFactory,
    ) {
    }

    public function ping(): PingResponse
    {
        $output = [];
        try {
            $output = $this->commandExecutor->execute(
                'ping -c ' . self::ATTEMPTS_COUNT . ' ' . self::DESTINATION_IP_ADDRESS
            );
            $isSuccess = true;
        } catch (ShellCommandException) {
            $isSuccess = false;
        }

        $matches = [];
        $output = implode(PHP_EOL, $output);

        $pregResult = preg_match("/.*time=(?<ping>.*)\sms/", $output, $matches);
        $ping = $pregResult && array_key_exists('ping', $matches) ? (int) $matches['ping'] : null;

        return $this->pingResponseFactory->create($isSuccess, $ping, $output);
    }
}
