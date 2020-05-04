<?php


namespace CodelyTv\Mooc\Shared\Infrastructure\Papertrail;

use CodelyTv\Mooc\Shared\Domain\Logger;

class PapertrailLogger extends Logger
{
    private string $hostname;
    private int $port;

    /**
     * PapertrailLogger constructor.
     * @param string $hostname to log to papertrail channel
     * @param int $port to log to papertrail channel
     */
    public function __construct(string $hostname, int $port)
    {
        $this->hostname = $hostname;
        $this->port = $port;
    }
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $level = parent::standardize($level, $this);
        $this->send_remote_syslog($level. ": ". $message);
    }

    /**
     * Courtesy of troy: https://gist.github.com/troy/2220679
     *
     * @param $message
     */
    private function send_remote_syslog($message)
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $syslog_message = "<22>" . date('M d H:i:s ') . 'web: ' . $message;
        socket_sendto($sock, $syslog_message, strlen($syslog_message), 0, $this->hostname, $this->port);
        socket_close($sock);
    }
}