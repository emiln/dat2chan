<?php
class PostLexer {
    protected static $_terminals = array(
        "/^(\(code\))/" => "T_CODE",
        "/^(\(bold)/" => "T_BOLD",
        "/^(\(cite)/" => "T_CITE",
        "/^(\(italic)/" => "T_ITALIC",
        "/^(\(quote)/" => "T_QUOTE",
        "/^(\".+\")/" => "T_STRING",
        "/^('.+')/" => "T_STRING",
        "/^(\d+)/" => "T_NUMBER",
        "/^(\()/" => "T_PAREN_START",
        "/^(\))/" => "T_PAREN_END",
        "/^(\s+)/" => "T_WHITESPACE",
        "/^([^\(\)]+)/" => "T_JUNK",
      );

    public static function get_terms() { return static::$_terminals; }

    public static function toHTML($tokens) {
        $code_scope = false;
        $open_tags = array();
        $res = "";
        for($i = 0; $i < count($tokens); $i++) {
            $t = $tokens[$i];
            switch ($t['token']) {
            case "T_CODE":
                $res .= $code_scope ? '</pre>' : '<pre>';
                $code_scope = !$code_scope;
                break;
            case "T_BOLD":
                $res .= '<b>';
                $open_tags[] = 'b';
                $i++;
                break;
            case "T_CITE":
                $cit = $tokens[$i + 2];
                if ($cit['token'] != "T_STRING") {
                    break;
                }
                $src = $tokens[$i + 4];
                if ($src['token'] != "T_JUNK") {
                    break;
                }
                $end = $tokens[$i + 5];
                if ($end['token'] != "T_PAREN_END") {
                    break;
                }
                $res .= '<blockquote cite=' . htmlentities($src['match']) .
                    '>' . htmlentities($cit['match']) . '</blockquote>';
                $i += 5;
                break;
            case "T_ITALIC":
                $res .= '<i>';
                $open_tags[] = 'i';
                $i++;
                break;
            case "T_QUOTE":
                $src = $tokens[$i + 2];
                if ($src['token'] != "T_NUMBER") {
                    break;
                }
                $res .= '<a href="' . $src['match'] . '">' . '#' .
                    $src['match'] . '</a>';
                $i += 2;
                break;
            case "T_JUNK":
                $res .= $t['match'];
                break;
            case "T_PAREN_END":
                $tag = array_pop($open_tags);
                if ($tag !== null) {
                    $res .= '</' . $tag . '>';
                }
                break;
            case "T_WHITESPACE":
                $res .= $t['match'];
                break;
            }
        }
        foreach($open_tags as $tag) {
            $res .= '</' . $tag . '>';
        }
        if ($code_scope == true) {
            $res .= "</pre>";
        }
        return $res;
    }

    public static function run($source) {
        $tokens = array();

        foreach($source as $number => $line) {
            $offset = 0;
            while($offset < strlen($line)) {
                $result = static::_match($line, $number, $offset);
                if($result === false) {
                    throw new Exception("Unable to parse line " . ($line+1) .
                      ".");
                }
                $tokens[] = $result;
                $offset += strlen($result['match']);
            }
        }

        return $tokens;
    }

    protected static function _match($line, $number, $offset) {
        $string = substr($line, $offset);

        foreach(static::$_terminals as $pattern => $name) {
            if(preg_match($pattern, $string, $matches)) {
                return array(
                    'match' => $matches[1],
                    'token' => $name
                  );
            }
        }

        return false;
    }
}
?>
