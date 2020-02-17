<?php 

function buildTree($elements, $parentId='') {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['sao'] == $parentId) {
            $children = buildTree($elements, $element['ids']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

function buildTreea($arr, $parent = 0, $indent = 0)
{
    foreach($arr as $item)
    {
        if ($item['sao'] == $parent)
        {
            if ($indent != 0)
            {
                echo str_repeat("&nbsp;", $indent) . "-&nbsp;";
            }
            echo $item['desk'] . '<br/>';
            buildTree($arr, $item['ids'], $indent + 2);
        }
    }
}
?>