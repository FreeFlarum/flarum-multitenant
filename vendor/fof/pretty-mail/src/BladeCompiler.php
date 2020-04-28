<?php

namespace FoF\PrettyMail;

use Symfony\Component\Debug\Exception\FatalThrowableError;

class BladeCompiler
{
    public static function render($string, $data)
    {
        $php = app('blade.compiler')->compileString($string);

        $obLevel = ob_get_level();
        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?'.'>'.$php);
        } catch (\Exception $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }

            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $obLevel) {
                ob_end_clean();
            }

            throw new FatalThrowableError($e);
        }

        return ob_get_clean();
    }
}
