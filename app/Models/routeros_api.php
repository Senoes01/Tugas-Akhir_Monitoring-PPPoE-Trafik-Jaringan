<?php

class RouterosAPI
{
    protected $socket;
    protected $connected = false;
    public $debug = false;

    public function connect($ip, $user, $pass, $port = 8728)
    {
        $this->socket = @fsockopen($ip, $port, $errno, $errstr, 3);
        if (!$this->socket) return false;

        $this->write('/login');
        $this->write("=name={$user}");
        $this->write("=password={$pass}");
        $this->write('', true);
        $response = $this->read(false);

        $this->connected = isset($response[0]) && $response[0] === '!done';
        return $this->connected;
    }

    public function write($command, $last = false)
    {
        if ($command !== '') {
            fwrite($this->socket, $this->encodeLength(strlen($command)) . $command);
        }
        if ($last) {
            fwrite($this->socket, chr(0));
        }
    }

    public function read($parse = true)
    {
        $response = [];
        while (true) {
            $len = ord(fread($this->socket, 1));
            if ($len == 0) break;
            $data = fread($this->socket, $len);
            $response[] = $data;
            if ($data === '!done') break;
        }
        return $parse ? $this->parseResponse($response) : $response;
    }

    public function comm($cmd, $params = [])
    {
        $this->write($cmd, empty($params));
        foreach ($params as $k => $v) {
            $this->write("={$k}={$v}", false);
        }
        $this->write('', true);
        return $this->read();
    }

    public function encodeLength($len)
    {
        if ($len < 0x80) return chr($len);
        if ($len < 0x4000) return chr(($len >> 8) | 0x80) . chr($len & 0xFF);
        if ($len < 0x200000) return chr(($len >> 16) | 0xC0) . chr(($len >> 8) & 0xFF) . chr($len & 0xFF);
        return chr(($len >> 24) | 0xE0) . chr(($len >> 16) & 0xFF) . chr(($len >> 8) & 0xFF) . chr($len & 0xFF);
    }

    public function parseResponse($resp)
    {
        $result = [];
        foreach ($resp as $r) {
            if (strpos($r, '=') === 0) {
                $parts = explode('=', $r);
                $result[$parts[1]] = $parts[2] ?? '';
            }
        }
        return $result;
    }

    public function disconnect()
    {
        if ($this->socket) fclose($this->socket);
        $this->connected = false;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}
