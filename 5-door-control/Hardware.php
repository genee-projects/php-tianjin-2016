<?php

class Hardware {

    private $fd;

    public function __construct($filename) {
        if (file_exists($filename)) {
            exec("/bin/stty -F $filename 4:0:cbf:0:3:1c:7f:15:4:0:1:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0");
            $this->fd = fopen($filename, 'rb+');
        }
    }

    function checksum($buf) {
        return array_reduce(array_map('ord', str_split($buf)), function($c, $ch) {
            return $c^$ch;
        }, 0);
    }

    function parseBuffer($buf) {
        $cmd = $buf[5];
        switch ($cmd) {
        case "\x01": // 读取到卡号
            $this->emit('card', bin2hex(substr($buf, 7)));
            break;
        }
    }

    function start() {
        if (!$this->fd) return;

        echo "开始监听硬件通讯...\n";

        $buf = '';
        $ret = swoole_event_add($this->fd, function($fd) use (& $buf) {
            $d = stream_get_contents($fd);
            if (strlen($d)==0) return;
            $buf .= $d;
            // searching for AAAA
            while (strlen($buf)) {
                if (strlen($buf) <= 3) {
                    break;
                }

                $pos = strpos($buf, "\xAA\xAA");
                if ($pos === false) {
                    $buf = null;
                    break;
                }

                if ($pos > 0) {
                    $buf = substr($buf, $pos);
                    if (strlen($buf) <=3) {
                        break;
                    }
                }

                $len = ord($buf[2]);
                if ($len == 0) {
                    $buf = substr($buf, 3);
                    continue;
                }

                if (strlen($buf) < $len) {
                    break;
                }

                $nbuf = substr($buf, 0, $len);
                $cs = ord($nbuf[3]);
                $nbuf[3] = "\x00"; // clean buffer
                if ($this->checksum($nbuf) == $cs) {
                    $this->parseBuffer($nbuf);
                    $buf = substr($buf, $len);
                } else {
                    $buf = substr($buf, 1);
                }
            }

        });
    }

    public function open() {
        $this->fd and fwrite($this->fd, "\xAA\xAA\x06\x04\x00\x02");
    }

    public function on($event, $callback) {
        $this->listeners[$event][] = $callback;
    }

    public function emit() {
        $args = func_get_args();
        $event = array_shift($args);
        if (isset($this->listeners[$event])) {
            foreach ((array)$this->listeners[$event] as $callback) {
                call_user_func_array($callback, $args);
            }
        }
    }

}
