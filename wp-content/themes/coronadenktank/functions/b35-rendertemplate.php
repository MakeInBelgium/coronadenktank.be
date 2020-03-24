<?php

function b35_renderTemplate($template, $v) {
  if (preg_match_all("/{{(.*?)}}/", $template, $m)) {
    foreach ($m[1] as $i => $varname) {
      $template = str_replace($m[0][$i], $v[$varname], $template);
    }
  }
  return $template;
}
