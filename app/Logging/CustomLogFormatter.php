<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Level;
use Monolog\Processor\IntrospectionProcessor;

class CustomLogFormatter extends LineFormatter
{
    const DEFAULT_MONOLOG_FORMAT = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
    const CUSTOM_FORMAT = "[%datetime%] %channel%.%level_name%: [message: %message%] | [context: %context%] | [function-call-type: %extra.callType%] | [line: %extra.line%] | [class: %extra.class%] | [function: %extra.function%] | [file: %extra.file%]\n";
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Customize the given logger instance.
     */
    public function __invoke(Logger $logger): void
    {
        /**
         * added custom processor to manipulate extra.class make the namespace lost.
         * 
         */
        $logger->pushProcessor(function ($record) {
            if (isset($record['extra']['class'])) {
                $record['extra']['class'] = class_basename($record['extra']['class']);
            }

            return $record;
        });

        /**
         *
         *   callType: Menunjukkan bagaimana method tersebut dipanggil.
         *       -> untuk pemanggilan objek/instance.
         *       :: untuk pemanggilan statis.
         *       Kosong jika dipanggil sebagai fungsi biasa.
         *
         */
        $logger->pushProcessor(new IntrospectionProcessor(
            Level::Debug,
            ['Illuminate\\']
        ));

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                self::CUSTOM_FORMAT,
                self::DATE_FORMAT,
                true,
                true
            ));
        }
    }
}
