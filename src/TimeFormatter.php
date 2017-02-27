<?php

namespace Realejo;

/**
 * Trabalha com horas independente do dia
 *
 * @todo o que fazer com tempo negativo? o que deve retornar no get()?
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2011-2014 Realejo (http://realejo.com.br)
 * @license   http://unlicense.org
 */
class TimeFormatter
{
    const HOUR = 'hh';
    const HOUR_SHORT = 'h';
    const MINUTE = 'mm';
    const MINUTE_SHORT = 'm';
    const SECOND = 'ss';
    const SECOND_SHORT = 's';
    const SIGNED = 'S';

    private $_time = 0;

    /**
     * TimeFormatter constructor.
     * @param null $time
     * @param null $part
     */
    public function __construct($time = null, $part = null)
    {
        if ($time instanceof \DateTime || self::isTime($time)) {
            $this->setTime($time, $part);
        }
    }

    /**
     * Valida se o tempo
     *
     * @param string $time
     * @return boolean
     */
    public static function isTime($time)
    {
        // Remove espaços caso haja
        $time = trim($time);

        // Verifica se é valida
        return (preg_match('/^(-?)(\d{1,2}):(\d{1,2}):(\d{1,2})$/', $time) == 1
            || preg_match('/^(-?)(\d{1,2}):(\d{1,2})$/', $time) == 1
            || preg_match('/^(-?)(\d*)$/', $time) == 1
            || preg_match('/^(-?)(\d*)\.(\d*)$/', $time) == 1
        );
    }

    /**
     * Grava o tempo de acordo com o formato
     *
     * @param string $time
     * @param string $part OPCIONAL Formato informado
     * @return $this
     * @throws \Exception
     */
    public function setTime($time, $part = null)
    {
        // Verifica se é \DateTime
        if ($time instanceof \DateTime) {
            $time = $time->format('H:i:s');
            $part = 'h:m:s';
        }

        if (!self::isTime($time)) {
            throw new \Exception("Tempo '$time' inválido");

        } elseif (strpos($time, ':') !== false || !empty($part)) {
            if (empty($part)) {
                $part = (substr_count($time, ':') == 1) ? 'm:s' : 'h:m:s';
            } else {
                $part = strtolower($part);
            }

            $aTime = explode(':', $time);
            $aPart = explode(':', $part);
            $h = $m = $s = 0;

            // @todo o que fazer quando $aTime mais informações no aTime que aPart?
            foreach ($aPart as $i => $p) {
                if ($p == self::HOUR || $p == self::HOUR_SHORT) {
                    $h = $aTime[$i];
                } elseif ($p == self::MINUTE || $p == self::MINUTE_SHORT) {
                    $m = $aTime[$i];
                } elseif ($p == self::SECOND || $p == self::SECOND_SHORT) {
                    $s = $aTime[$i];
                }
            }
            $this->_time = $s + 60 * $m + 60 * 60 * $h;
        } else {
            // Considera que é um numero
            $this->_time = (int)$time;
        }

        return $this;
    }

    /**
     * Retorna o tempo formatado
     *
     * @param string $format OPCIONAL formato a ser retornado
     * @return string
     */
    public function toString($format = 'Shh:mm:ss')
    {
        // Define o tempo a ser usado
        $time = $this->_time;

        // Verifica o sinal
        if ($this->_time < 0) {
            $format = str_replace('S', '-', $format);
            $time = -$time;
        } else {
            $format = str_replace('S', '', $format);
        }

        // Calcula os tempos
        $s = $time % 60;
        $m = (($time - $s) / 60) % 60;
        $h = ($time - 60 * $m - $s) / (60 * 60);

        // Imprime o formato escolhido
        $format = str_replace(array('ss', 's', 'mm', 'm', 'hh', 'h'),
            array(
                str_pad($s, 2, '0', STR_PAD_LEFT),
                $s,
                str_pad($m, 2, '0', STR_PAD_LEFT),
                $m,
                str_pad($h, 2, '0', STR_PAD_LEFT),
                $h
            ),
            $format);

        // Retorna a hora formatada
        return $format;
    }

    /**
     * Grava os segundos do tempo
     *
     * @param int $seconds
     * @return \Realejo\TimeFormatter
     */
    public function setSeconds($seconds)
    {
        $this->_time -= $this->get(TimeFormatter::SECOND);
        $this->_time += $seconds;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Retorna apenas um pedaço do tempo
     *
     * @param  string $part Pedaço desejado
     * @return string
     */
    public function get($part = null)
    {
        // Separa o tempo
        $s = $this->_time % 60;
        $m = (($this->_time - $s) / 60) % 60;
        $h = ($this->_time - 60 * $m - $s) / (60 * 60);

        // Retorna o part
        switch ($part) {
            case self::SECOND :
                return str_pad($s, 2, '0', STR_PAD_LEFT);
            case self::SECOND_SHORT:
                return (string)$s;
            case self::MINUTE :
                return str_pad($m, 2, '0', STR_PAD_LEFT);
            case self::MINUTE_SHORT:
                return (string)$m;
            case self::HOUR :
                return str_pad($h, 2, '0', STR_PAD_LEFT);
            case self::HOUR_SHORT:
                return (string)$h;
        }

        return 0;
    }

    /**
     * Recupera o total de minutos
     *
     * @return int
     */
    public function getMinutes()
    {
        return $this->_time / 60;
    }

    /**
     * Grava os minutos do tempo
     *
     * @param int $minutes
     * @return \Realejo\TimeFormatter
     */
    public function setMinutes($minutes)
    {
        $this->_time -= $this->get(TimeFormatter::MINUTE) * 60;
        $this->_time += $minutes * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }


    /**
     * Retorna o total de horas do tempo
     *
     * @return int
     */
    public function getHours()
    {
        return $this->_time / (60 * 60);
    }

    /**
     * Grava as horas no tempo
     *
     * @param int $hours
     * @return \Realejo\TimeFormatter
     */
    public function setHours($hours)
    {
        $this->_time -= $this->get(TimeFormatter::HOUR) * 60 * 60;
        $this->_time += $hours * 60 * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Adiciona um tempo
     *
     * @param string|\Realejo\TimeFormatter $time Tempo a ser adicionado
     * @param string $part OPCIONAL caso seja passado um string e não \Realejo\TimeFormatter
     * @return \Realejo\TimeFormatter
     */
    public function addTime($time, $part = null)
    {
        // Verifica se é um objeto \Realejo\TimeFormatter
        if (!($time instanceof TimeFormatter)) {
            $time = new TimeFormatter($time, $part);
        }

        // Adiciona o tempo
        $this->_time += $time->getSeconds();

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Retorna o total de segundos do tempo
     *
     * @return int $time
     */
    public function getSeconds()
    {
        return $this->_time;
    }

    /**
     * Subtrai um tempo
     *
     * @param string|\Realejo\TimeFormatter $time Tempo a ser subtraído
     * @param string $part OPCIONAL caso seja passado um string e não \Realejo\TimeFormatter
     * @return \Realejo\TimeFormatter
     */
    public function subTime($time, $part = null)
    {
        // Verifica se é um objeto \Realejo\TimeFormatter
        if (!($time instanceof TimeFormatter)) {
            $time = new TimeFormatter($time, $part);
        }

        // Subtrai o tempo
        $this->_time -= $time->getSeconds();

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Adiciona segundos
     *
     * @param int $seconds
     * @return \Realejo\TimeFormatter
     */
    public function addSeconds($seconds)
    {
        // Adiciona os segundos
        $this->_time += $seconds;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Subtrai segundos
     *
     * @param int $seconds
     * @return \Realejo\TimeFormatter
     */
    public function subSeconds($seconds)
    {
        // Subtrai os segundos
        $this->_time -= $seconds;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Adiciona minutes
     *
     * @param int $minutes
     * @return \Realejo\TimeFormatter
     */
    public function addMinutes($minutes)
    {
        // Adiciona os minutos passados
        $this->_time += $minutes * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Subtrai minutos
     *
     * @param int $minutes
     * @return \Realejo\TimeFormatter
     */
    public function subMinutes($minutes)
    {
        // Subtrai os minutos passados
        $this->_time -= $minutes * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Adiciona horas
     *
     * @param int $hours
     * @return \Realejo\TimeFormatter
     */
    public function addHours($hours)
    {
        // Adiciona as horas passadas
        $this->_time += $hours * 60 * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

    /**
     * Subtrai horas
     *
     * @param int $hours
     * @return \Realejo\TimeFormatter
     */
    public function subHours($hours)
    {
        // Subtrai as horas passadas
        $this->_time -= $hours * 60 * 60;

        // Retorna o \Realejo\TimeFormatter para manter a cadeia
        return $this;
    }

}
