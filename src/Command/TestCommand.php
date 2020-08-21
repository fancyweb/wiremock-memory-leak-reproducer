<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\CurlHttpClient;

final class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $httpClient = new CurlHttpClient([
            'base_uri' => 'http://wiremock:8080/',
        ]);

        $responses = [];
        $s = microtime(true);
        for ($i = 1; $i <= 10000; $i++) {
            $responses[] = $httpClient->request('GET', \sprintf('%s/%s/%s/%s', $i, $i+1, $i+2, $i+3));

            if (0 === $i % 500) {
                foreach ($httpClient->stream($responses) as $response => $chunk) {

                }

                $responses = [];

                echo \sprintf('Last 500 took %s seconds.', microtime(true) - $s);
                echo "\n";

                $s = microtime(true);
            }
        }

        return 0;
    }
}
