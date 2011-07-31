<?php
/**
 * DokuWiki Plugin redmine (Syntax Component)
 *
 * @license MIT
 * @author  Stefan Simroth <stefan.simroth@ubicoo.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_redmine_timesheet extends DokuWiki_Syntax_Plugin {
    public function getType() {
        return 'container';
    }

    public function getPType() {
        return 'block';
    }

    public function getSort() {
        return 998;
    }


    public function connectTo($mode) {
//        $this->Lexer->addSpecialPattern('<TIMESHEET>',$mode,'plugin_redmine_timesheet');
        $this->Lexer->addEntryPattern('<TIMESHEET>',$mode,'plugin_redmine_timesheet');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</TIMESHEET>','plugin_redmine_timesheet');
    }

    public function handle($match, $state, $pos, &$handler){
        switch ($state) {
          case DOKU_LEXER_ENTER :
                //list($color, $background) = preg_split("/\//u", substr($match, 6, -1), 2);
                //if ($color = $this->_isValid($color)) $color = "color:$color;";
                //if ($background = $this->_isValid($background)) $background = "background-color:$background;";
                return array($state, ''); //, array($color, $background));

          case DOKU_LEXER_UNMATCHED :  return array($state, $match);
          case DOKU_LEXER_EXIT :       return array($state, '');
        }
        return array();
    }

    public function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;
           list($state,$match) = $data;
            switch ($state) {
              case DOKU_LEXER_ENTER :
                //list($color, $background) = $match;
                $renderer->doc .= "<p>". $this->getLang('timesheet') ."</p>";
                break;

              //case DOKU_LEXER_UNMATCHED :  $renderer->doc .= $renderer->_xmlEntities($match); break;
              //case DOKU_LEXER_EXIT :       $renderer->doc .= "</span>"; break;
            }
        return true;
    }
}

// vim:ts=4:sw=4:et:
