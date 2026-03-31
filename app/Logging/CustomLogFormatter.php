<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
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
         * Processor 1: Truncate Base64 di Message dan Context
         */
        $logger->pushProcessor(function ($record) {
            // 1. Pastikan message adalah string (karena Log::debug($page) mengubah object ke JSON)
            $message = is_string($record->message) ?
                $record->message :
                json_encode($record->message);

            // 2. Jalankan pembersihan berantai
            // Potong Base64
            $message = $this->truncateBase64InString($message);

            // Potong Description (hanya sisakan 100 karakter pertama)
            $message = $this->truncateLongFields($message, 'description');

            return $record->with(
                message: $message,
                context: $this->truncateBase64Recursive($record->context)
            );
        });

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

    /**
     * Memotong base64 di dalam string menggunakan Regex yang mendukung JSON escape
     */
    private function truncateBase64InString(string $text): string
    {
        /**
         * Penjelasan Regex Baru:
         * ~                     : Delimiter
         * (data:[^;]+;base64,)  : Group 1: Menangkap prefix (mendukung \/)
         * [^"]{30,}             : Menangkap karakter APA PUN selain tanda petik dua (") 
         * sebanyak minimal 30 karakter.
         * ~                     : Delimiter
         */
        return preg_replace(
            '~(data:[^;]+;base64,)[^"]{30,}~',
            '$1...(truncated)',
            $text
        );
    }

    /**
     * Helper untuk memotong string base64 secara rekursif
     */
    private function truncateBase64Recursive(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->truncateBase64Recursive($value);
            } elseif (is_string($value)) {
                $data[$key] = $this->truncateBase64InString($value);
            }
        }
        return $data;
    }

    /**
     * Memotong field spesifik (seperti description) jika terlalu panjang dalam string JSON
     */
    private function truncateLongFields(string $text, string $key = 'description', int $limit = 10): string
    {
        /**
         * Penjelasan Regex:
         * ~                     : Delimiter
         * ("description":")     : Group 1: Mencari kunci dan tanda petik pembuka
         * ([^"]{100})           : Group 2: Mengambil 100 karakter pertama (selain tanda petik)
         * [^"]+                 : Mengambil sisa karakter yang akan dibuang
         * (")                   : Group 3: Tanda petik penutup
         */
        $pattern = '~("' . $key . '":")([^"]{' . $limit . '})[^"]+(")~';

        return preg_replace($pattern, '$1$2...(truncated)$3', $text);
    }
}
