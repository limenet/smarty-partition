<?php
/**
 * This function partitions an array into n subarrays which can be used for column layouts
 * @param  array $params    An array consisting of the keys array, size, and name; name is the name of the output array, size is the number of columns, array is the array to be partitioned
 * @param  Smarty $template Used by Smarty internally
 * @param  boolean $test    Whether the functions is used in a unit test or not
 * @return array            Returns the partitoned array
 */
 
function smarty_function_partition($params, $template, $test = false) {

    if ((int) $params['size'] <= 0) {
        if (!$test) {
            $template->assign($params['name'], []);
        } else {
            return [$params['name'] => []];
        }
    }

    $listlen   = count($params['array']);
    $partlen   = floor($listlen / $params['size']);
    $partrem   = $listlen % $params['size'];
    $partition = [];
    $mark      = 0;
    for ($px = 0; $px < $params['size']; $px++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($params['array'] ?: [], $mark, $incr);
        $mark += $incr;
    }


    if (!$test) {
        $template->assign($params['name'], $partition);
    } else {
        return [$params['name'] => $partition];
    }
}
