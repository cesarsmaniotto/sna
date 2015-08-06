<?php

namespace comunic\social_network_analyzer\model\util{

    class StringUtil {

        const ACCENT_STRINGS = 'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËẼÌÍÎÏĨÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëẽìíîïĩðñòóôõöøùúûüýÿ';
        const NO_ACCENT_STRINGS = 'SOZsozYYuAAAAAAACEEEEEIIIIIDNOOOOOOUUUUYsaaaaaaaceeeeeiiiiionoooooouuuuyy';
        const PUNCTUATION = '! " # $ % & \' ( ) … * + , - . / : ; < = > ? @ [ \\ ] ^ _ ` { | } ~';

     
/**
* Returna uma string com acento em uma expressão REGEX para encontrar todas as variantes
* em formato não-sensitivo ao acento.
* Obtido em: http://tech.rgou.net/php/pesquisas-nao-sensiveis-ao-caso-e-acento-no-mongodb-e-php/
*
* @param string $text O texto.
* @return string O texto em REGEX.
*/
static public function accentToRegex($text)
{
    $from = str_split(utf8_decode(self::ACCENT_STRINGS));
    $to   = str_split(strtolower(self::NO_ACCENT_STRINGS));
    $text = utf8_decode($text);
    $regex = array();
    foreach ($to as $key => $value){
        if (isset($regex[$value])){
            $regex[$value] .= $from[$key];
        } else {
            $regex[$value] = $value;
            $regex[$value] .= $from[$key];
        }
    }
    foreach ($regex as $rg_key => $rg){
/**
* Marca os caracteres acentuados que serão substituídos com suas outras variantes
*/
$text = preg_replace("/[$rg]/", "_{$rg_key}_", $text);
}
foreach ($regex as $rg_key => $rg){
    $text = preg_replace("/_{$rg_key}_/", "[$rg]", $text);
}
return utf8_encode($text);
}

static public function removePunctuation($string){
    $explodePunctuation = \explode(" ", self::PUNCTUATION);
    $string = \trim($string);
    return \str_replace($explodePunctuation, "", $string);
}


}



}
?>