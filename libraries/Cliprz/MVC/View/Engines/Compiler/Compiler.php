<?php

/**
 * Part of the Cliprz framework
 *
 * @package    Cliprz
 * @author     Yousef Ismaeil <cliprz@gmail.com>
 * @copyright  Copyright (c) 2013 - 2014, Cliprz Developers team
 * @license    MIT
 * @link       http://www.cliprz.org
 * @version    1.0.0
 */

/**
 * @note this class is in dev not for humman use :)
 */

namespace Cliprz\MVC\View\Engines\Compiler;

class Compiler {

    const NEWLINE = "\r\n";
    const TAB = "\t";

    /**
     * Compiling list
     *
     * @var array
     * @access private
     */
    private $compilingList = [];

    public function __construct (){
        $this->compilingList = [
            '`\{{1}(include|require)\s*:{1}\s*(.*)\}{1}`i' => '<?php $1(\'$2\'); ?>',
            '`\{php\}(.*)\{\/php\}`is'                     => '<?php'.static::NEWLINE.'$1'.static::NEWLINE.'?>',
            '`\{([a-z0-9_-]+)\}`i'                         => '<?php echo ((isset($$1)) ? $$1 : \'invalid {$1} variable\'); ?>'
        ];
    }

    /**
     * Compile contents
     *
     * @param string file contents
     * @access public
     */
    public function compile ($contents) {
        return preg_replace(
            array_keys($this->compilingList),
            array_values($this->compilingList),
            $contents);
    }

    public function save ($filename) {
        if (is_file($filename)) {
            $contents = file_get_contents($filename);
            $compile = $this->compile($contents);
            file_put_contents(APPPATH.'Cache/test.php',$compile);
        } else {
            echo $filename.' not exsits.';
        }
    }

}

?>