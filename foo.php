<?php

/**
 * Function foo                     As soon as there is an overlap between 2 pairs the function create a new pair with the smallest for the first element and the largest for the second 
 * search_overlaps array            An array of pairs elements
 * 
 * return merged_overlaps array   An array of pairs elements merged when overlaped
 */
function foo($search_overlaps)
{
    if (count($search_overlaps) <= 1) {
        return $search_overlaps;
    }

    $merged_overlaps[] = $search_overlaps[0];

    foreach ($search_overlaps as $i => $source) {
        $j = 0;
        $overlaped = false;
        while (!$overlaped && $j < count($merged_overlaps)) {
            $target = $merged_overlaps[$j];
            $overlaped = ($source[0] >= $target[0] && $source[0] <= $target[1]) 
                    || ($source[1] >= $target[0] && $source[1] <= $target[1]);
            $j++;
        }
        if ($overlaped) {
            $merged_overlaps[$j - 1] = [min($source[0], $target[0]), max($source[1], $target[1])];
        } else {
            $merged_overlaps[] = $source;
        }
    }

    usort($merged_overlaps, function ($first_element, $second_element) {
        return $first_element[0] >= $second_element[0];
    });

    return $merged_overlaps;
}

print_r(foo([[0, 3], [6, 10]]));
print_r(foo([[0, 5], [3, 10]]));
print_r(foo([[0, 5], [2, 4]]));
print_r(foo([[7, 8], [3, 6], [2, 4]]));
print_r(foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]));

?>
