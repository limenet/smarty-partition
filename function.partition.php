<?php

/**
 * This function partitions an array into n subarrays which can be used for column layouts.
 *
 * @see http://www.php.net/array_chunk#75022 source of the original function
 *
 * @param array                    $params   An array consisting of the keys array, size, and name; name is the name of the output array, size is the number of columns, array is the array to be partitioned
 * @param Smarty_Internal_Template $template Used by Smarty internally
 *
 * @return array Returns the partitoned array
 */
function smarty_function_partition($params, Smarty_Internal_Template $template = null)
{
    // First, we inline the parameters into better understandable variables.
    $numberOfParts = $params['size'];
    $inputList = $params['array'];
    $outputName = $params['name'];

    // If the number of parts requested is non-positive, error out.
    if ((int) $numberOfParts <= 0) {
        if (!empty($template)) {
            $template->assign($outputName, []);

            return;
        } else {
            return [$outputName => []];
        }
    }

    // Set up the loop to split the input up.
    $lengthOfList = count($inputList);
    $lengthOfOnePart = floor($lengthOfList / $numberOfParts);
    $lengthOfRemainder = $lengthOfList % $numberOfParts;
    $partition = [];
    $mark = 0;

    // Loop over the array and fill the columns.
    // The first column may contain up to (n -1) more elements than the other columns.
    // n is equal to the number of parts.
    for ($px = 0; $px < $numberOfParts; $px++) {
        $increment = ($px < $lengthOfRemainder) ? $lengthOfOnePart + 1 : $lengthOfOnePart;
        $partition[$px] = array_slice($inputList ?: [], $mark, $increment);
        $mark += $increment;
    }

    // Return the partitioned array with the pre-defined name.
    if (!empty($template)) {
        $template->assign($outputName, $partition);
    } else {
        return [$outputName => $partition];
    }
}
