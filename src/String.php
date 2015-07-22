<?php
/**
 * Classe para manipular strings
 *
 * @link      http://github.com/realejo/library
 * @copyright Copyright (c) 2014 Realejo Design Ltda. (http://www.realejo.com.br)
 */
namespace Realejo;

class String
{
    /**
     * Remove os acentos pelas letras correspondetes
     *
     * @param string $subject
     *
     * @return string
     */
    public static function RemoveAcentos($subject)
    {
        $specialChars = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',  'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',  'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ',  'ĳ',  'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',  'œ',  'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ',  'ǽ',  'Ǿ', 'ǿ');
        $correctChars = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($specialChars, $correctChars, $subject);
    }

    /**
     * Strip tags com tags e atributos permitidos
     *
     * @param str $string
     * @param str $allowtags
     * @param str $allowattributes
     * @return str
     */
    public static function strip_tags_attributes($string, $allowtags=NULL, $allowattributes=NULL)
    {
        if ($allowattributes) {
            if (!is_array($allowattributes)) {
                $allowattributes = explode(",", $allowattributes);
            }

            foreach ($allowattributes as $aa) {
                $count = substr_count($string, $aa);
                for ($i=0; $i<$count; $i++) {
                    $rep = '/([^>]*) ('.$aa.')(=)(\'.*\'|".*")/i';
                    $string = preg_replace($rep, '$1 $2_-_-$4', $string);
                }
            }
        }

        return strip_tags($string, $allowtags);
    }

    /**
     * Remove os caracteres que não podem estar no nome do arquivo
     *
     * @todo remover acentos e não apaga-los
     *
     * @param string $file
     * @return string
     */
    public static function cleanFileName($subject)
    {
        $subject = preg_replace('/\s+/', '_', self::RemoveAcentos(trim($subject)));
        $search  = array( "([\40])" , "([^a-zA-Z0-9-._])", "(-{2,})" );
        $replace = array("-", "", "-");
        return strtolower(preg_replace($search, $replace, $subject));
    }

    /**
     * Remove os caracteres ilegais
     *
     * @todo un-orkutify?
     * @todo colocar no RWLBI?
     * @todo deveria ser um Zend_Filter?
     * @todo HTMLPurifier?
     *
     * @param array|string $words
     * @param array $options
     *
     * @return array|string
     */
    public static function sanitize($words, $options = null)
    {
        // Verifica se é um array
        $isArray = true;
        if (!is_array($words)) {
            $isArray = false;
            $words = array($words);
        }

        // Verifica se $options é um array
        if (empty($options)) {
            $options = array();
        } elseif (!is_array($options)) {
            $options = array($options);
        }

        // Verifica se o ignore é um array
        if (!isset($options['ignore'])) {
            $options['ignore'] = array();
        } elseif (isset($options['ignore']) && !is_array($options['ignore'])) {
            $options['ignore'] = array($options['ignore']);
        }

        // Faz o filtro
        foreach ($words as $k=>$v) {
            // Verifica se deve ignorar
            if (in_array($k, $options['ignore']) || $v === null) {
                continue;
            }

            // Faz o filtro
            $v = filter_var($v, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

            // Verifica o filtro de URL
            if (isset($options['url']) || in_array('url', $options)) {
                $v = filter_var($v, FILTER_SANITIZE_URL);
            }

            // Verifica o white list
            $specialChars = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
            $pattern = '/[^A-Za-z0-9_\`\~\!\@\#\$\%\^\*\(\)\; \,\.\'\/\_\-' . implode('', $specialChars) . ']/iu';
            $v = preg_replace($pattern, '', $v);

            // Verifica o black list


            // Remove os espaços a mais
            $v = preg_replace('/\s+/', ' ', $v);

            // Coloca de volta na lista
            $words[$k] = trim($v);
        }

        // Retorna as palavras filtradas
        return ($isArray) ? $words : $words[0];
    }

    /**
     * Transforma uma string em url friendly
     *
     * @param str $string
     * @param str $space
     *
     * @return string
     */
    public static function getSlug($string, $space="-")
    {
        // Passa apra UTF8
        $string = self::toUTF8(trim($string));

        // remove os acentos considerando o UTF8
        $string = self::RemoveAcentos(mb_strtolower($string, 'UTF8'));
        $string = preg_replace('([_|\s]+)', '-', $string); // change all spaces and underscores to a hyphen
        $string = preg_replace('([^a-z0-9-])', '', $string); // remove all non-numeric characters except the hyphen
        $string = preg_replace('([-]+)', '-', $string); // replace multiple instances of the hyphen with a single instance
        $string = preg_replace('(^-+|-+$)', '', $string); // trim leading and trailing hyphens
        $string = str_replace('-', $space, $string);

        return trim($string);
    }

    /**
     * Extrai o código da URL considerando o primeiro hifen ou virgula
     *
     * @param  $slug string
     *
     * @return string
     */
    public static function getSlugId($slug, $delimiter = null)
    {
        // Remove acentos
        $slug = self::RemoveAcentos($slug);

        // Remove os caracteres inválidos
        $slug = self::getSafeSlug($slug);

        // Define o delimitador
        if (empty($delimiter)) {
            if (strpos($slug, ',') && strpos($slug, '-')) {
                $delimiter = (strpos($slug, ',') < strpos($slug, '-')) ? ',':'-';
            } elseif (strpos($slug, ',')) {
                $delimiter = ',';
            } elseif (strpos($slug, '-')) {
                $delimiter = '-';
            }
        }

        // Verifica se há um delimitador
        if (!empty($delimiter)) {

            // Verifica se ele está presente
            if (strpos($slug, $delimiter)) {
                // Extrai a parte antes do delimitador
                $slug = explode($delimiter, $slug);
                $slug = $slug[0];
            }
        }

        // Retorna o ID
        return $slug;
    }

    /**
     * Extrai o código válido ([A-Za-z0-9_])
     *
     * @param str $string
     * @return string
     */
    public static function getSafeID($codigo)
    {
        $codigo = strip_tags($codigo);
        $codigo = preg_replace('/[^A-Za-z0-9_]/', '', $codigo);
        return trim($codigo);
    }

    /**
     * Extrai o slug da URL excluíndo caracteres inválidos
     *
     * @param str $string
     * @return string
     */
    public static function getSafeSlug($url)
    {
        $url = strip_tags($url);
        $url = preg_replace('/[^,A-Za-z0-9_-]/', '', $url);
        return trim($url);
    }

    public static function cleanHTML($html,  $allowable_tags = null)
    {
        if (is_null($html)) {
            return '';
        }

        $texto = strip_tags($html,  $allowable_tags);
        $texto = str_replace('&nbsp;', ' ', $texto);
        $texto = preg_replace('/\n/', ' ', $texto);
        $texto = preg_replace('/\t/', ' ', $texto);
        $texto = preg_replace('/\s\s+/', ' ', $texto);

        // volta os acentos
        $texto = html_entity_decode($texto, ENT_COMPAT, 'UTF-8');

        return trim($texto);
    }

    /**
     * Detecta se está em UTF-8 e converte se necessário
     *
     * @param string $string
     *
     * @return string
     */
    public static function toUTF8($string)
    {
        /**
         * Verifica se está em UTF-8
         *
         * O truque é que se converter de UTF-8 para UTF-8 ele apaga os caracteres,
         * então muda o tamanho do strlen. Mas não funciona com mb_strlen
         */
        if (strlen($string) != strlen(mb_convert_encoding($string, 'UTF-8', 'UTF-8'))) {
            $string = mb_convert_encoding($string, 'UTF-8');
        }

        // Retorna a string
        return $string;
    }
}
