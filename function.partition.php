<?php

function smarty_function_partition($params, $template) {
    $listlen   = count( $params['array'] );
    $partlen   = floor( $listlen / $params['size'] );
    $partrem   = $listlen % $params['size'];
    $partition = [];
    $mark      = 0;
    for ($px = 0; $px < $params['size']; $px++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice( $params['array'], $mark, $incr );
        $mark += $incr;
    }
    $template->assign($params['name'], $partition);
}